<?php
namespace PHPMaker2020\klinik_latest_26_03_21;

/**
 * Page class
 */
class permintaanpembelian_add extends permintaanpembelian
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{7561FF98-88C2-4B76-B5C9-C5F11860BCF7}";

	// Table name
	public $TableName = 'permintaanpembelian';

	// Page object name
	public $PageObjName = "permintaanpembelian_add";

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

		// Table object (permintaanpembelian)
		if (!isset($GLOBALS["permintaanpembelian"]) || get_class($GLOBALS["permintaanpembelian"]) == PROJECT_NAMESPACE . "permintaanpembelian") {
			$GLOBALS["permintaanpembelian"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["permintaanpembelian"];
		}

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'permintaanpembelian');

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
		global $permintaanpembelian;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($permintaanpembelian);
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
					if ($pageName == "permintaanpembelianview.php")
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
			$key .= @$ar['id_pp'];
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
			$this->id_pp->Visible = FALSE;
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
					$this->terminate(GetUrl("permintaanpembelianlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id_pp->Visible = FALSE;
		$this->no_pp->setVisibility();
		$this->namapaket_pp->setVisibility();
		$this->tgl_pp->setVisibility();
		$this->tgl_kebutuhan->setVisibility();
		$this->tgl_persetujuan->setVisibility();
		$this->staf_pengajuan->setVisibility();
		$this->staf_validasi->setVisibility();
		$this->id_suplier->setVisibility();
		$this->idklinik->setVisibility();
		$this->validasi->setVisibility();
		$this->status->setVisibility();
		$this->email_pusat->setVisibility();
		$this->email_cabang->setVisibility();
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
		$this->setupLookupOptions($this->staf_pengajuan);
		$this->setupLookupOptions($this->staf_validasi);
		$this->setupLookupOptions($this->id_suplier);
		$this->setupLookupOptions($this->idklinik);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("permintaanpembelianlist.php");
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
			if (Get("id_pp") !== NULL) {
				$this->id_pp->setQueryStringValue(Get("id_pp"));
				$this->setKey("id_pp", $this->id_pp->CurrentValue); // Set up key
			} else {
				$this->setKey("id_pp", ""); // Clear key
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
					$this->terminate("permintaanpembelianlist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = "permintaanpembelianlist.php";
					if (GetPageName($returnUrl) == "permintaanpembelianlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "permintaanpembelianview.php")
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
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->id_pp->CurrentValue = NULL;
		$this->id_pp->OldValue = $this->id_pp->CurrentValue;
		$this->no_pp->CurrentValue = NULL;
		$this->no_pp->OldValue = $this->no_pp->CurrentValue;
		$this->namapaket_pp->CurrentValue = NULL;
		$this->namapaket_pp->OldValue = $this->namapaket_pp->CurrentValue;
		$this->tgl_pp->CurrentValue = NULL;
		$this->tgl_pp->OldValue = $this->tgl_pp->CurrentValue;
		$this->tgl_kebutuhan->CurrentValue = NULL;
		$this->tgl_kebutuhan->OldValue = $this->tgl_kebutuhan->CurrentValue;
		$this->tgl_persetujuan->CurrentValue = NULL;
		$this->tgl_persetujuan->OldValue = $this->tgl_persetujuan->CurrentValue;
		$this->staf_pengajuan->CurrentValue = NULL;
		$this->staf_pengajuan->OldValue = $this->staf_pengajuan->CurrentValue;
		$this->staf_validasi->CurrentValue = NULL;
		$this->staf_validasi->OldValue = $this->staf_validasi->CurrentValue;
		$this->id_suplier->CurrentValue = NULL;
		$this->id_suplier->OldValue = $this->id_suplier->CurrentValue;
		$this->idklinik->CurrentValue = NULL;
		$this->idklinik->OldValue = $this->idklinik->CurrentValue;
		$this->validasi->CurrentValue = NULL;
		$this->validasi->OldValue = $this->validasi->CurrentValue;
		$this->status->CurrentValue = NULL;
		$this->status->OldValue = $this->status->CurrentValue;
		$this->email_pusat->CurrentValue = NULL;
		$this->email_pusat->OldValue = $this->email_pusat->CurrentValue;
		$this->email_cabang->CurrentValue = NULL;
		$this->email_cabang->OldValue = $this->email_cabang->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'no_pp' first before field var 'x_no_pp'
		$val = $CurrentForm->hasValue("no_pp") ? $CurrentForm->getValue("no_pp") : $CurrentForm->getValue("x_no_pp");
		if (!$this->no_pp->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->no_pp->Visible = FALSE; // Disable update for API request
			else
				$this->no_pp->setFormValue($val);
		}

		// Check field name 'namapaket_pp' first before field var 'x_namapaket_pp'
		$val = $CurrentForm->hasValue("namapaket_pp") ? $CurrentForm->getValue("namapaket_pp") : $CurrentForm->getValue("x_namapaket_pp");
		if (!$this->namapaket_pp->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->namapaket_pp->Visible = FALSE; // Disable update for API request
			else
				$this->namapaket_pp->setFormValue($val);
		}

		// Check field name 'tgl_pp' first before field var 'x_tgl_pp'
		$val = $CurrentForm->hasValue("tgl_pp") ? $CurrentForm->getValue("tgl_pp") : $CurrentForm->getValue("x_tgl_pp");
		if (!$this->tgl_pp->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tgl_pp->Visible = FALSE; // Disable update for API request
			else
				$this->tgl_pp->setFormValue($val);
			$this->tgl_pp->CurrentValue = UnFormatDateTime($this->tgl_pp->CurrentValue, 0);
		}

		// Check field name 'tgl_kebutuhan' first before field var 'x_tgl_kebutuhan'
		$val = $CurrentForm->hasValue("tgl_kebutuhan") ? $CurrentForm->getValue("tgl_kebutuhan") : $CurrentForm->getValue("x_tgl_kebutuhan");
		if (!$this->tgl_kebutuhan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tgl_kebutuhan->Visible = FALSE; // Disable update for API request
			else
				$this->tgl_kebutuhan->setFormValue($val);
			$this->tgl_kebutuhan->CurrentValue = UnFormatDateTime($this->tgl_kebutuhan->CurrentValue, 0);
		}

		// Check field name 'tgl_persetujuan' first before field var 'x_tgl_persetujuan'
		$val = $CurrentForm->hasValue("tgl_persetujuan") ? $CurrentForm->getValue("tgl_persetujuan") : $CurrentForm->getValue("x_tgl_persetujuan");
		if (!$this->tgl_persetujuan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tgl_persetujuan->Visible = FALSE; // Disable update for API request
			else
				$this->tgl_persetujuan->setFormValue($val);
			$this->tgl_persetujuan->CurrentValue = UnFormatDateTime($this->tgl_persetujuan->CurrentValue, 0);
		}

		// Check field name 'staf_pengajuan' first before field var 'x_staf_pengajuan'
		$val = $CurrentForm->hasValue("staf_pengajuan") ? $CurrentForm->getValue("staf_pengajuan") : $CurrentForm->getValue("x_staf_pengajuan");
		if (!$this->staf_pengajuan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->staf_pengajuan->Visible = FALSE; // Disable update for API request
			else
				$this->staf_pengajuan->setFormValue($val);
		}

		// Check field name 'staf_validasi' first before field var 'x_staf_validasi'
		$val = $CurrentForm->hasValue("staf_validasi") ? $CurrentForm->getValue("staf_validasi") : $CurrentForm->getValue("x_staf_validasi");
		if (!$this->staf_validasi->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->staf_validasi->Visible = FALSE; // Disable update for API request
			else
				$this->staf_validasi->setFormValue($val);
		}

		// Check field name 'id_suplier' first before field var 'x_id_suplier'
		$val = $CurrentForm->hasValue("id_suplier") ? $CurrentForm->getValue("id_suplier") : $CurrentForm->getValue("x_id_suplier");
		if (!$this->id_suplier->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_suplier->Visible = FALSE; // Disable update for API request
			else
				$this->id_suplier->setFormValue($val);
		}

		// Check field name 'idklinik' first before field var 'x_idklinik'
		$val = $CurrentForm->hasValue("idklinik") ? $CurrentForm->getValue("idklinik") : $CurrentForm->getValue("x_idklinik");
		if (!$this->idklinik->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->idklinik->Visible = FALSE; // Disable update for API request
			else
				$this->idklinik->setFormValue($val);
		}

		// Check field name 'validasi' first before field var 'x_validasi'
		$val = $CurrentForm->hasValue("validasi") ? $CurrentForm->getValue("validasi") : $CurrentForm->getValue("x_validasi");
		if (!$this->validasi->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->validasi->Visible = FALSE; // Disable update for API request
			else
				$this->validasi->setFormValue($val);
		}

		// Check field name 'status' first before field var 'x_status'
		$val = $CurrentForm->hasValue("status") ? $CurrentForm->getValue("status") : $CurrentForm->getValue("x_status");
		if (!$this->status->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->status->Visible = FALSE; // Disable update for API request
			else
				$this->status->setFormValue($val);
		}

		// Check field name 'email_pusat' first before field var 'x_email_pusat'
		$val = $CurrentForm->hasValue("email_pusat") ? $CurrentForm->getValue("email_pusat") : $CurrentForm->getValue("x_email_pusat");
		if (!$this->email_pusat->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->email_pusat->Visible = FALSE; // Disable update for API request
			else
				$this->email_pusat->setFormValue($val);
		}

		// Check field name 'email_cabang' first before field var 'x_email_cabang'
		$val = $CurrentForm->hasValue("email_cabang") ? $CurrentForm->getValue("email_cabang") : $CurrentForm->getValue("x_email_cabang");
		if (!$this->email_cabang->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->email_cabang->Visible = FALSE; // Disable update for API request
			else
				$this->email_cabang->setFormValue($val);
		}

		// Check field name 'id_pp' first before field var 'x_id_pp'
		$val = $CurrentForm->hasValue("id_pp") ? $CurrentForm->getValue("id_pp") : $CurrentForm->getValue("x_id_pp");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->no_pp->CurrentValue = $this->no_pp->FormValue;
		$this->namapaket_pp->CurrentValue = $this->namapaket_pp->FormValue;
		$this->tgl_pp->CurrentValue = $this->tgl_pp->FormValue;
		$this->tgl_pp->CurrentValue = UnFormatDateTime($this->tgl_pp->CurrentValue, 0);
		$this->tgl_kebutuhan->CurrentValue = $this->tgl_kebutuhan->FormValue;
		$this->tgl_kebutuhan->CurrentValue = UnFormatDateTime($this->tgl_kebutuhan->CurrentValue, 0);
		$this->tgl_persetujuan->CurrentValue = $this->tgl_persetujuan->FormValue;
		$this->tgl_persetujuan->CurrentValue = UnFormatDateTime($this->tgl_persetujuan->CurrentValue, 0);
		$this->staf_pengajuan->CurrentValue = $this->staf_pengajuan->FormValue;
		$this->staf_validasi->CurrentValue = $this->staf_validasi->FormValue;
		$this->id_suplier->CurrentValue = $this->id_suplier->FormValue;
		$this->idklinik->CurrentValue = $this->idklinik->FormValue;
		$this->validasi->CurrentValue = $this->validasi->FormValue;
		$this->status->CurrentValue = $this->status->FormValue;
		$this->email_pusat->CurrentValue = $this->email_pusat->FormValue;
		$this->email_cabang->CurrentValue = $this->email_cabang->FormValue;
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
		$this->id_pp->setDbValue($row['id_pp']);
		$this->no_pp->setDbValue($row['no_pp']);
		$this->namapaket_pp->setDbValue($row['namapaket_pp']);
		$this->tgl_pp->setDbValue($row['tgl_pp']);
		$this->tgl_kebutuhan->setDbValue($row['tgl_kebutuhan']);
		$this->tgl_persetujuan->setDbValue($row['tgl_persetujuan']);
		$this->staf_pengajuan->setDbValue($row['staf_pengajuan']);
		$this->staf_validasi->setDbValue($row['staf_validasi']);
		$this->id_suplier->setDbValue($row['id_suplier']);
		$this->idklinik->setDbValue($row['idklinik']);
		$this->validasi->setDbValue($row['validasi']);
		$this->status->setDbValue($row['status']);
		$this->email_pusat->setDbValue($row['email_pusat']);
		$this->email_cabang->setDbValue($row['email_cabang']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id_pp'] = $this->id_pp->CurrentValue;
		$row['no_pp'] = $this->no_pp->CurrentValue;
		$row['namapaket_pp'] = $this->namapaket_pp->CurrentValue;
		$row['tgl_pp'] = $this->tgl_pp->CurrentValue;
		$row['tgl_kebutuhan'] = $this->tgl_kebutuhan->CurrentValue;
		$row['tgl_persetujuan'] = $this->tgl_persetujuan->CurrentValue;
		$row['staf_pengajuan'] = $this->staf_pengajuan->CurrentValue;
		$row['staf_validasi'] = $this->staf_validasi->CurrentValue;
		$row['id_suplier'] = $this->id_suplier->CurrentValue;
		$row['idklinik'] = $this->idklinik->CurrentValue;
		$row['validasi'] = $this->validasi->CurrentValue;
		$row['status'] = $this->status->CurrentValue;
		$row['email_pusat'] = $this->email_pusat->CurrentValue;
		$row['email_cabang'] = $this->email_cabang->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id_pp")) != "")
			$this->id_pp->OldValue = $this->getKey("id_pp"); // id_pp
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
		// id_pp
		// no_pp
		// namapaket_pp
		// tgl_pp
		// tgl_kebutuhan
		// tgl_persetujuan
		// staf_pengajuan
		// staf_validasi
		// id_suplier
		// idklinik
		// validasi
		// status
		// email_pusat
		// email_cabang

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id_pp
			$this->id_pp->ViewValue = $this->id_pp->CurrentValue;
			$this->id_pp->ViewCustomAttributes = "";

			// no_pp
			$this->no_pp->ViewValue = $this->no_pp->CurrentValue;
			$this->no_pp->ViewCustomAttributes = "";

			// namapaket_pp
			$this->namapaket_pp->ViewValue = $this->namapaket_pp->CurrentValue;
			$this->namapaket_pp->ViewCustomAttributes = "";

			// tgl_pp
			$this->tgl_pp->ViewValue = $this->tgl_pp->CurrentValue;
			$this->tgl_pp->ViewValue = FormatDateTime($this->tgl_pp->ViewValue, 0);
			$this->tgl_pp->ViewCustomAttributes = "";

			// tgl_kebutuhan
			$this->tgl_kebutuhan->ViewValue = $this->tgl_kebutuhan->CurrentValue;
			$this->tgl_kebutuhan->ViewValue = FormatDateTime($this->tgl_kebutuhan->ViewValue, 0);
			$this->tgl_kebutuhan->ViewCustomAttributes = "";

			// tgl_persetujuan
			$this->tgl_persetujuan->ViewValue = $this->tgl_persetujuan->CurrentValue;
			$this->tgl_persetujuan->ViewValue = FormatDateTime($this->tgl_persetujuan->ViewValue, 0);
			$this->tgl_persetujuan->ViewCustomAttributes = "";

			// staf_pengajuan
			$curVal = strval($this->staf_pengajuan->CurrentValue);
			if ($curVal != "") {
				$this->staf_pengajuan->ViewValue = $this->staf_pengajuan->lookupCacheOption($curVal);
				if ($this->staf_pengajuan->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_pegawai`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->staf_pengajuan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->staf_pengajuan->ViewValue = $this->staf_pengajuan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->staf_pengajuan->ViewValue = $this->staf_pengajuan->CurrentValue;
					}
				}
			} else {
				$this->staf_pengajuan->ViewValue = NULL;
			}
			$this->staf_pengajuan->ViewCustomAttributes = "";

			// staf_validasi
			$curVal = strval($this->staf_validasi->CurrentValue);
			if ($curVal != "") {
				$this->staf_validasi->ViewValue = $this->staf_validasi->lookupCacheOption($curVal);
				if ($this->staf_validasi->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_pegawai`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->staf_validasi->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->staf_validasi->ViewValue = $this->staf_validasi->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->staf_validasi->ViewValue = $this->staf_validasi->CurrentValue;
					}
				}
			} else {
				$this->staf_validasi->ViewValue = NULL;
			}
			$this->staf_validasi->ViewCustomAttributes = "";

			// id_suplier
			$curVal = strval($this->id_suplier->CurrentValue);
			if ($curVal != "") {
				$this->id_suplier->ViewValue = $this->id_suplier->lookupCacheOption($curVal);
				if ($this->id_suplier->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_supplier`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_suplier->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_suplier->ViewValue = $this->id_suplier->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_suplier->ViewValue = $this->id_suplier->CurrentValue;
					}
				}
			} else {
				$this->id_suplier->ViewValue = NULL;
			}
			$this->id_suplier->ViewCustomAttributes = "";

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

			// validasi
			$this->validasi->ViewValue = $this->validasi->CurrentValue;
			$this->validasi->ViewValue = FormatNumber($this->validasi->ViewValue, 0, -2, -2, -2);
			$this->validasi->ViewCustomAttributes = "";

			// status
			if (strval($this->status->CurrentValue) != "") {
				$this->status->ViewValue = $this->status->optionCaption($this->status->CurrentValue);
			} else {
				$this->status->ViewValue = NULL;
			}
			$this->status->ViewCustomAttributes = "";

			// email_pusat
			$this->email_pusat->ViewValue = $this->email_pusat->CurrentValue;
			$this->email_pusat->ViewCustomAttributes = "";

			// email_cabang
			$this->email_cabang->ViewValue = $this->email_cabang->CurrentValue;
			$this->email_cabang->ViewCustomAttributes = "";

			// no_pp
			$this->no_pp->LinkCustomAttributes = "";
			$this->no_pp->HrefValue = "";
			$this->no_pp->TooltipValue = "";

			// namapaket_pp
			$this->namapaket_pp->LinkCustomAttributes = "";
			$this->namapaket_pp->HrefValue = "";
			$this->namapaket_pp->TooltipValue = "";

			// tgl_pp
			$this->tgl_pp->LinkCustomAttributes = "";
			$this->tgl_pp->HrefValue = "";
			$this->tgl_pp->TooltipValue = "";

			// tgl_kebutuhan
			$this->tgl_kebutuhan->LinkCustomAttributes = "";
			$this->tgl_kebutuhan->HrefValue = "";
			$this->tgl_kebutuhan->TooltipValue = "";

			// tgl_persetujuan
			$this->tgl_persetujuan->LinkCustomAttributes = "";
			$this->tgl_persetujuan->HrefValue = "";
			$this->tgl_persetujuan->TooltipValue = "";

			// staf_pengajuan
			$this->staf_pengajuan->LinkCustomAttributes = "";
			$this->staf_pengajuan->HrefValue = "";
			$this->staf_pengajuan->TooltipValue = "";

			// staf_validasi
			$this->staf_validasi->LinkCustomAttributes = "";
			$this->staf_validasi->HrefValue = "";
			$this->staf_validasi->TooltipValue = "";

			// id_suplier
			$this->id_suplier->LinkCustomAttributes = "";
			$this->id_suplier->HrefValue = "";
			$this->id_suplier->TooltipValue = "";

			// idklinik
			$this->idklinik->LinkCustomAttributes = "";
			$this->idklinik->HrefValue = "";
			$this->idklinik->TooltipValue = "";

			// validasi
			$this->validasi->LinkCustomAttributes = "";
			$this->validasi->HrefValue = "";
			$this->validasi->TooltipValue = "";

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";
			$this->status->TooltipValue = "";

			// email_pusat
			$this->email_pusat->LinkCustomAttributes = "";
			$this->email_pusat->HrefValue = "";
			$this->email_pusat->TooltipValue = "";

			// email_cabang
			$this->email_cabang->LinkCustomAttributes = "";
			$this->email_cabang->HrefValue = "";
			$this->email_cabang->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// no_pp
			$this->no_pp->EditAttrs["class"] = "form-control";
			$this->no_pp->EditCustomAttributes = "";
			if (!$this->no_pp->Raw)
				$this->no_pp->CurrentValue = HtmlDecode($this->no_pp->CurrentValue);
			$this->no_pp->EditValue = HtmlEncode($this->no_pp->CurrentValue);
			$this->no_pp->PlaceHolder = RemoveHtml($this->no_pp->caption());

			// namapaket_pp
			$this->namapaket_pp->EditAttrs["class"] = "form-control";
			$this->namapaket_pp->EditCustomAttributes = "";
			if (!$this->namapaket_pp->Raw)
				$this->namapaket_pp->CurrentValue = HtmlDecode($this->namapaket_pp->CurrentValue);
			$this->namapaket_pp->EditValue = HtmlEncode($this->namapaket_pp->CurrentValue);
			$this->namapaket_pp->PlaceHolder = RemoveHtml($this->namapaket_pp->caption());

			// tgl_pp
			$this->tgl_pp->EditAttrs["class"] = "form-control";
			$this->tgl_pp->EditCustomAttributes = "";
			$this->tgl_pp->EditValue = HtmlEncode(FormatDateTime($this->tgl_pp->CurrentValue, 8));
			$this->tgl_pp->PlaceHolder = RemoveHtml($this->tgl_pp->caption());

			// tgl_kebutuhan
			$this->tgl_kebutuhan->EditAttrs["class"] = "form-control";
			$this->tgl_kebutuhan->EditCustomAttributes = "";
			$this->tgl_kebutuhan->EditValue = HtmlEncode(FormatDateTime($this->tgl_kebutuhan->CurrentValue, 8));
			$this->tgl_kebutuhan->PlaceHolder = RemoveHtml($this->tgl_kebutuhan->caption());

			// tgl_persetujuan
			$this->tgl_persetujuan->EditAttrs["class"] = "form-control";
			$this->tgl_persetujuan->EditCustomAttributes = "";
			$this->tgl_persetujuan->EditValue = HtmlEncode(FormatDateTime($this->tgl_persetujuan->CurrentValue, 8));
			$this->tgl_persetujuan->PlaceHolder = RemoveHtml($this->tgl_persetujuan->caption());

			// staf_pengajuan
			$this->staf_pengajuan->EditAttrs["class"] = "form-control";
			$this->staf_pengajuan->EditCustomAttributes = "";
			$curVal = trim(strval($this->staf_pengajuan->CurrentValue));
			if ($curVal != "")
				$this->staf_pengajuan->ViewValue = $this->staf_pengajuan->lookupCacheOption($curVal);
			else
				$this->staf_pengajuan->ViewValue = $this->staf_pengajuan->Lookup !== NULL && is_array($this->staf_pengajuan->Lookup->Options) ? $curVal : NULL;
			if ($this->staf_pengajuan->ViewValue !== NULL) { // Load from cache
				$this->staf_pengajuan->EditValue = array_values($this->staf_pengajuan->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_pegawai`" . SearchString("=", $this->staf_pengajuan->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->staf_pengajuan->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->staf_pengajuan->EditValue = $arwrk;
			}

			// staf_validasi
			$this->staf_validasi->EditAttrs["class"] = "form-control";
			$this->staf_validasi->EditCustomAttributes = "";
			$curVal = trim(strval($this->staf_validasi->CurrentValue));
			if ($curVal != "")
				$this->staf_validasi->ViewValue = $this->staf_validasi->lookupCacheOption($curVal);
			else
				$this->staf_validasi->ViewValue = $this->staf_validasi->Lookup !== NULL && is_array($this->staf_validasi->Lookup->Options) ? $curVal : NULL;
			if ($this->staf_validasi->ViewValue !== NULL) { // Load from cache
				$this->staf_validasi->EditValue = array_values($this->staf_validasi->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_pegawai`" . SearchString("=", $this->staf_validasi->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->staf_validasi->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->staf_validasi->EditValue = $arwrk;
			}

			// id_suplier
			$this->id_suplier->EditAttrs["class"] = "form-control";
			$this->id_suplier->EditCustomAttributes = "";
			$curVal = trim(strval($this->id_suplier->CurrentValue));
			if ($curVal != "")
				$this->id_suplier->ViewValue = $this->id_suplier->lookupCacheOption($curVal);
			else
				$this->id_suplier->ViewValue = $this->id_suplier->Lookup !== NULL && is_array($this->id_suplier->Lookup->Options) ? $curVal : NULL;
			if ($this->id_suplier->ViewValue !== NULL) { // Load from cache
				$this->id_suplier->EditValue = array_values($this->id_suplier->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_supplier`" . SearchString("=", $this->id_suplier->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->id_suplier->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->id_suplier->EditValue = $arwrk;
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

			// validasi
			$this->validasi->EditAttrs["class"] = "form-control";
			$this->validasi->EditCustomAttributes = "";
			$this->validasi->EditValue = HtmlEncode($this->validasi->CurrentValue);
			$this->validasi->PlaceHolder = RemoveHtml($this->validasi->caption());

			// status
			$this->status->EditCustomAttributes = "";
			$this->status->EditValue = $this->status->options(FALSE);

			// email_pusat
			$this->email_pusat->EditAttrs["class"] = "form-control";
			$this->email_pusat->EditCustomAttributes = "";
			if (!$this->email_pusat->Raw)
				$this->email_pusat->CurrentValue = HtmlDecode($this->email_pusat->CurrentValue);
			$this->email_pusat->EditValue = HtmlEncode($this->email_pusat->CurrentValue);
			$this->email_pusat->PlaceHolder = RemoveHtml($this->email_pusat->caption());

			// email_cabang
			$this->email_cabang->EditAttrs["class"] = "form-control";
			$this->email_cabang->EditCustomAttributes = "";
			if (!$this->email_cabang->Raw)
				$this->email_cabang->CurrentValue = HtmlDecode($this->email_cabang->CurrentValue);
			$this->email_cabang->EditValue = HtmlEncode($this->email_cabang->CurrentValue);
			$this->email_cabang->PlaceHolder = RemoveHtml($this->email_cabang->caption());

			// Add refer script
			// no_pp

			$this->no_pp->LinkCustomAttributes = "";
			$this->no_pp->HrefValue = "";

			// namapaket_pp
			$this->namapaket_pp->LinkCustomAttributes = "";
			$this->namapaket_pp->HrefValue = "";

			// tgl_pp
			$this->tgl_pp->LinkCustomAttributes = "";
			$this->tgl_pp->HrefValue = "";

			// tgl_kebutuhan
			$this->tgl_kebutuhan->LinkCustomAttributes = "";
			$this->tgl_kebutuhan->HrefValue = "";

			// tgl_persetujuan
			$this->tgl_persetujuan->LinkCustomAttributes = "";
			$this->tgl_persetujuan->HrefValue = "";

			// staf_pengajuan
			$this->staf_pengajuan->LinkCustomAttributes = "";
			$this->staf_pengajuan->HrefValue = "";

			// staf_validasi
			$this->staf_validasi->LinkCustomAttributes = "";
			$this->staf_validasi->HrefValue = "";

			// id_suplier
			$this->id_suplier->LinkCustomAttributes = "";
			$this->id_suplier->HrefValue = "";

			// idklinik
			$this->idklinik->LinkCustomAttributes = "";
			$this->idklinik->HrefValue = "";

			// validasi
			$this->validasi->LinkCustomAttributes = "";
			$this->validasi->HrefValue = "";

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";

			// email_pusat
			$this->email_pusat->LinkCustomAttributes = "";
			$this->email_pusat->HrefValue = "";

			// email_cabang
			$this->email_cabang->LinkCustomAttributes = "";
			$this->email_cabang->HrefValue = "";
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
		if ($this->no_pp->Required) {
			if (!$this->no_pp->IsDetailKey && $this->no_pp->FormValue != NULL && $this->no_pp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->no_pp->caption(), $this->no_pp->RequiredErrorMessage));
			}
		}
		if ($this->namapaket_pp->Required) {
			if (!$this->namapaket_pp->IsDetailKey && $this->namapaket_pp->FormValue != NULL && $this->namapaket_pp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->namapaket_pp->caption(), $this->namapaket_pp->RequiredErrorMessage));
			}
		}
		if ($this->tgl_pp->Required) {
			if (!$this->tgl_pp->IsDetailKey && $this->tgl_pp->FormValue != NULL && $this->tgl_pp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgl_pp->caption(), $this->tgl_pp->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tgl_pp->FormValue)) {
			AddMessage($FormError, $this->tgl_pp->errorMessage());
		}
		if ($this->tgl_kebutuhan->Required) {
			if (!$this->tgl_kebutuhan->IsDetailKey && $this->tgl_kebutuhan->FormValue != NULL && $this->tgl_kebutuhan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgl_kebutuhan->caption(), $this->tgl_kebutuhan->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tgl_kebutuhan->FormValue)) {
			AddMessage($FormError, $this->tgl_kebutuhan->errorMessage());
		}
		if ($this->tgl_persetujuan->Required) {
			if (!$this->tgl_persetujuan->IsDetailKey && $this->tgl_persetujuan->FormValue != NULL && $this->tgl_persetujuan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgl_persetujuan->caption(), $this->tgl_persetujuan->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tgl_persetujuan->FormValue)) {
			AddMessage($FormError, $this->tgl_persetujuan->errorMessage());
		}
		if ($this->staf_pengajuan->Required) {
			if (!$this->staf_pengajuan->IsDetailKey && $this->staf_pengajuan->FormValue != NULL && $this->staf_pengajuan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->staf_pengajuan->caption(), $this->staf_pengajuan->RequiredErrorMessage));
			}
		}
		if ($this->staf_validasi->Required) {
			if (!$this->staf_validasi->IsDetailKey && $this->staf_validasi->FormValue != NULL && $this->staf_validasi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->staf_validasi->caption(), $this->staf_validasi->RequiredErrorMessage));
			}
		}
		if ($this->id_suplier->Required) {
			if (!$this->id_suplier->IsDetailKey && $this->id_suplier->FormValue != NULL && $this->id_suplier->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_suplier->caption(), $this->id_suplier->RequiredErrorMessage));
			}
		}
		if ($this->idklinik->Required) {
			if (!$this->idklinik->IsDetailKey && $this->idklinik->FormValue != NULL && $this->idklinik->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->idklinik->caption(), $this->idklinik->RequiredErrorMessage));
			}
		}
		if ($this->validasi->Required) {
			if (!$this->validasi->IsDetailKey && $this->validasi->FormValue != NULL && $this->validasi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->validasi->caption(), $this->validasi->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->validasi->FormValue)) {
			AddMessage($FormError, $this->validasi->errorMessage());
		}
		if ($this->status->Required) {
			if ($this->status->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
			}
		}
		if ($this->email_pusat->Required) {
			if (!$this->email_pusat->IsDetailKey && $this->email_pusat->FormValue != NULL && $this->email_pusat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->email_pusat->caption(), $this->email_pusat->RequiredErrorMessage));
			}
		}
		if ($this->email_cabang->Required) {
			if (!$this->email_cabang->IsDetailKey && $this->email_cabang->FormValue != NULL && $this->email_cabang->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->email_cabang->caption(), $this->email_cabang->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("detailmintapembelian", $detailTblVar) && $GLOBALS["detailmintapembelian"]->DetailAdd) {
			if (!isset($GLOBALS["detailmintapembelian_grid"]))
				$GLOBALS["detailmintapembelian_grid"] = new detailmintapembelian_grid(); // Get detail page object
			$GLOBALS["detailmintapembelian_grid"]->validateGridForm();
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
		}
		$rsnew = [];

		// no_pp
		$this->no_pp->setDbValueDef($rsnew, $this->no_pp->CurrentValue, NULL, FALSE);

		// namapaket_pp
		$this->namapaket_pp->setDbValueDef($rsnew, $this->namapaket_pp->CurrentValue, NULL, FALSE);

		// tgl_pp
		$this->tgl_pp->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_pp->CurrentValue, 0), NULL, FALSE);

		// tgl_kebutuhan
		$this->tgl_kebutuhan->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_kebutuhan->CurrentValue, 0), NULL, FALSE);

		// tgl_persetujuan
		$this->tgl_persetujuan->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_persetujuan->CurrentValue, 0), NULL, FALSE);

		// staf_pengajuan
		$this->staf_pengajuan->setDbValueDef($rsnew, $this->staf_pengajuan->CurrentValue, NULL, FALSE);

		// staf_validasi
		$this->staf_validasi->setDbValueDef($rsnew, $this->staf_validasi->CurrentValue, NULL, FALSE);

		// id_suplier
		$this->id_suplier->setDbValueDef($rsnew, $this->id_suplier->CurrentValue, NULL, FALSE);

		// idklinik
		$this->idklinik->setDbValueDef($rsnew, $this->idklinik->CurrentValue, NULL, FALSE);

		// validasi
		$this->validasi->setDbValueDef($rsnew, $this->validasi->CurrentValue, NULL, FALSE);

		// status
		$this->status->setDbValueDef($rsnew, $this->status->CurrentValue, NULL, FALSE);

		// email_pusat
		$this->email_pusat->setDbValueDef($rsnew, $this->email_pusat->CurrentValue, NULL, FALSE);

		// email_cabang
		$this->email_cabang->setDbValueDef($rsnew, $this->email_cabang->CurrentValue, NULL, FALSE);

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

		// Add detail records
		if ($addRow) {
			$detailTblVar = explode(",", $this->getCurrentDetailTable());
			if (in_array("detailmintapembelian", $detailTblVar) && $GLOBALS["detailmintapembelian"]->DetailAdd) {
				$GLOBALS["detailmintapembelian"]->pid_pp->setSessionValue($this->id_pp->CurrentValue); // Set master key
				if (!isset($GLOBALS["detailmintapembelian_grid"]))
					$GLOBALS["detailmintapembelian_grid"] = new detailmintapembelian_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "detailmintapembelian"); // Load user level of detail table
				$addRow = $GLOBALS["detailmintapembelian_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["detailmintapembelian"]->pid_pp->setSessionValue(""); // Clear master key if insert failed
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
			if (in_array("detailmintapembelian", $detailTblVar)) {
				if (!isset($GLOBALS["detailmintapembelian_grid"]))
					$GLOBALS["detailmintapembelian_grid"] = new detailmintapembelian_grid();
				if ($GLOBALS["detailmintapembelian_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["detailmintapembelian_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["detailmintapembelian_grid"]->CurrentMode = "add";
					$GLOBALS["detailmintapembelian_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["detailmintapembelian_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["detailmintapembelian_grid"]->setStartRecordNumber(1);
					$GLOBALS["detailmintapembelian_grid"]->pid_pp->IsDetailKey = TRUE;
					$GLOBALS["detailmintapembelian_grid"]->pid_pp->CurrentValue = $this->id_pp->CurrentValue;
					$GLOBALS["detailmintapembelian_grid"]->pid_pp->setSessionValue($GLOBALS["detailmintapembelian_grid"]->pid_pp->CurrentValue);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("permintaanpembelianlist.php"), "", $this->TableVar, TRUE);
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
				case "x_staf_pengajuan":
					break;
				case "x_staf_validasi":
					break;
				case "x_id_suplier":
					break;
				case "x_idklinik":
					break;
				case "x_status":
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
						case "x_staf_pengajuan":
							break;
						case "x_staf_validasi":
							break;
						case "x_id_suplier":
							break;
						case "x_idklinik":
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