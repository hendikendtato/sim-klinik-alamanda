<?php
namespace PHPMaker2020\klinik_latest_09_04_21;

/**
 * Page class
 */
class m_pegawai_add extends m_pegawai
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{8C91985A-7590-4658-895B-4BCC6B46002F}";

	// Table name
	public $TableName = 'm_pegawai';

	// Page object name
	public $PageObjName = "m_pegawai_add";

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

		// Table object (m_pegawai)
		if (!isset($GLOBALS["m_pegawai"]) || get_class($GLOBALS["m_pegawai"]) == PROJECT_NAMESPACE . "m_pegawai") {
			$GLOBALS["m_pegawai"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["m_pegawai"];
		}

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'm_pegawai');

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
		global $m_pegawai;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($m_pegawai);
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
					if ($pageName == "m_pegawaiview.php")
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
			$key .= @$ar['id_pegawai'];
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
			$this->id_pegawai->Visible = FALSE;
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
					$this->terminate(GetUrl("m_pegawailist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id_pegawai->Visible = FALSE;
		$this->nama_pegawai->setVisibility();
		$this->nama_lengkap->setVisibility();
		$this->jenis_pegawai->setVisibility();
		$this->nik_pegawai->setVisibility();
		$this->agama_pegawai->setVisibility();
		$this->tgllahir_pegawai->setVisibility();
		$this->alamat_pegawai->setVisibility();
		$this->hp_pegawai->setVisibility();
		$this->pendidikan_pegawai->setVisibility();
		$this->jurusan_pegawai->setVisibility();
		$this->spesialis_pegawai->setVisibility();
		$this->jabatan_pegawai->setVisibility();
		$this->status_pegawai->setVisibility();
		$this->tarif_pegawai->setVisibility();
		$this->id_klinik->setVisibility();
		$this->target->Visible = FALSE;
		$this->nilai_komisi->Visible = FALSE;
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
		$this->setupLookupOptions($this->agama_pegawai);
		$this->setupLookupOptions($this->jabatan_pegawai);
		$this->setupLookupOptions($this->id_klinik);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("m_pegawailist.php");
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
			if (Get("id_pegawai") !== NULL) {
				$this->id_pegawai->setQueryStringValue(Get("id_pegawai"));
				$this->setKey("id_pegawai", $this->id_pegawai->CurrentValue); // Set up key
			} else {
				$this->setKey("id_pegawai", ""); // Clear key
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
					$this->terminate("m_pegawailist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "m_pegawailist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "m_pegawaiview.php")
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
		$this->id_pegawai->CurrentValue = NULL;
		$this->id_pegawai->OldValue = $this->id_pegawai->CurrentValue;
		$this->nama_pegawai->CurrentValue = NULL;
		$this->nama_pegawai->OldValue = $this->nama_pegawai->CurrentValue;
		$this->nama_lengkap->CurrentValue = NULL;
		$this->nama_lengkap->OldValue = $this->nama_lengkap->CurrentValue;
		$this->jenis_pegawai->CurrentValue = NULL;
		$this->jenis_pegawai->OldValue = $this->jenis_pegawai->CurrentValue;
		$this->nik_pegawai->CurrentValue = NULL;
		$this->nik_pegawai->OldValue = $this->nik_pegawai->CurrentValue;
		$this->agama_pegawai->CurrentValue = NULL;
		$this->agama_pegawai->OldValue = $this->agama_pegawai->CurrentValue;
		$this->tgllahir_pegawai->CurrentValue = NULL;
		$this->tgllahir_pegawai->OldValue = $this->tgllahir_pegawai->CurrentValue;
		$this->alamat_pegawai->CurrentValue = NULL;
		$this->alamat_pegawai->OldValue = $this->alamat_pegawai->CurrentValue;
		$this->hp_pegawai->CurrentValue = NULL;
		$this->hp_pegawai->OldValue = $this->hp_pegawai->CurrentValue;
		$this->pendidikan_pegawai->CurrentValue = NULL;
		$this->pendidikan_pegawai->OldValue = $this->pendidikan_pegawai->CurrentValue;
		$this->jurusan_pegawai->CurrentValue = NULL;
		$this->jurusan_pegawai->OldValue = $this->jurusan_pegawai->CurrentValue;
		$this->spesialis_pegawai->CurrentValue = NULL;
		$this->spesialis_pegawai->OldValue = $this->spesialis_pegawai->CurrentValue;
		$this->jabatan_pegawai->CurrentValue = NULL;
		$this->jabatan_pegawai->OldValue = $this->jabatan_pegawai->CurrentValue;
		$this->status_pegawai->CurrentValue = NULL;
		$this->status_pegawai->OldValue = $this->status_pegawai->CurrentValue;
		$this->tarif_pegawai->CurrentValue = NULL;
		$this->tarif_pegawai->OldValue = $this->tarif_pegawai->CurrentValue;
		$this->id_klinik->CurrentValue = NULL;
		$this->id_klinik->OldValue = $this->id_klinik->CurrentValue;
		$this->target->CurrentValue = NULL;
		$this->target->OldValue = $this->target->CurrentValue;
		$this->nilai_komisi->CurrentValue = NULL;
		$this->nilai_komisi->OldValue = $this->nilai_komisi->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'nama_pegawai' first before field var 'x_nama_pegawai'
		$val = $CurrentForm->hasValue("nama_pegawai") ? $CurrentForm->getValue("nama_pegawai") : $CurrentForm->getValue("x_nama_pegawai");
		if (!$this->nama_pegawai->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nama_pegawai->Visible = FALSE; // Disable update for API request
			else
				$this->nama_pegawai->setFormValue($val);
		}

		// Check field name 'nama_lengkap' first before field var 'x_nama_lengkap'
		$val = $CurrentForm->hasValue("nama_lengkap") ? $CurrentForm->getValue("nama_lengkap") : $CurrentForm->getValue("x_nama_lengkap");
		if (!$this->nama_lengkap->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nama_lengkap->Visible = FALSE; // Disable update for API request
			else
				$this->nama_lengkap->setFormValue($val);
		}

		// Check field name 'jenis_pegawai' first before field var 'x_jenis_pegawai'
		$val = $CurrentForm->hasValue("jenis_pegawai") ? $CurrentForm->getValue("jenis_pegawai") : $CurrentForm->getValue("x_jenis_pegawai");
		if (!$this->jenis_pegawai->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jenis_pegawai->Visible = FALSE; // Disable update for API request
			else
				$this->jenis_pegawai->setFormValue($val);
		}

		// Check field name 'nik_pegawai' first before field var 'x_nik_pegawai'
		$val = $CurrentForm->hasValue("nik_pegawai") ? $CurrentForm->getValue("nik_pegawai") : $CurrentForm->getValue("x_nik_pegawai");
		if (!$this->nik_pegawai->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nik_pegawai->Visible = FALSE; // Disable update for API request
			else
				$this->nik_pegawai->setFormValue($val);
		}

		// Check field name 'agama_pegawai' first before field var 'x_agama_pegawai'
		$val = $CurrentForm->hasValue("agama_pegawai") ? $CurrentForm->getValue("agama_pegawai") : $CurrentForm->getValue("x_agama_pegawai");
		if (!$this->agama_pegawai->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->agama_pegawai->Visible = FALSE; // Disable update for API request
			else
				$this->agama_pegawai->setFormValue($val);
		}

		// Check field name 'tgllahir_pegawai' first before field var 'x_tgllahir_pegawai'
		$val = $CurrentForm->hasValue("tgllahir_pegawai") ? $CurrentForm->getValue("tgllahir_pegawai") : $CurrentForm->getValue("x_tgllahir_pegawai");
		if (!$this->tgllahir_pegawai->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tgllahir_pegawai->Visible = FALSE; // Disable update for API request
			else
				$this->tgllahir_pegawai->setFormValue($val);
			$this->tgllahir_pegawai->CurrentValue = UnFormatDateTime($this->tgllahir_pegawai->CurrentValue, 0);
		}

		// Check field name 'alamat_pegawai' first before field var 'x_alamat_pegawai'
		$val = $CurrentForm->hasValue("alamat_pegawai") ? $CurrentForm->getValue("alamat_pegawai") : $CurrentForm->getValue("x_alamat_pegawai");
		if (!$this->alamat_pegawai->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->alamat_pegawai->Visible = FALSE; // Disable update for API request
			else
				$this->alamat_pegawai->setFormValue($val);
		}

		// Check field name 'hp_pegawai' first before field var 'x_hp_pegawai'
		$val = $CurrentForm->hasValue("hp_pegawai") ? $CurrentForm->getValue("hp_pegawai") : $CurrentForm->getValue("x_hp_pegawai");
		if (!$this->hp_pegawai->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->hp_pegawai->Visible = FALSE; // Disable update for API request
			else
				$this->hp_pegawai->setFormValue($val);
		}

		// Check field name 'pendidikan_pegawai' first before field var 'x_pendidikan_pegawai'
		$val = $CurrentForm->hasValue("pendidikan_pegawai") ? $CurrentForm->getValue("pendidikan_pegawai") : $CurrentForm->getValue("x_pendidikan_pegawai");
		if (!$this->pendidikan_pegawai->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->pendidikan_pegawai->Visible = FALSE; // Disable update for API request
			else
				$this->pendidikan_pegawai->setFormValue($val);
		}

		// Check field name 'jurusan_pegawai' first before field var 'x_jurusan_pegawai'
		$val = $CurrentForm->hasValue("jurusan_pegawai") ? $CurrentForm->getValue("jurusan_pegawai") : $CurrentForm->getValue("x_jurusan_pegawai");
		if (!$this->jurusan_pegawai->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jurusan_pegawai->Visible = FALSE; // Disable update for API request
			else
				$this->jurusan_pegawai->setFormValue($val);
		}

		// Check field name 'spesialis_pegawai' first before field var 'x_spesialis_pegawai'
		$val = $CurrentForm->hasValue("spesialis_pegawai") ? $CurrentForm->getValue("spesialis_pegawai") : $CurrentForm->getValue("x_spesialis_pegawai");
		if (!$this->spesialis_pegawai->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->spesialis_pegawai->Visible = FALSE; // Disable update for API request
			else
				$this->spesialis_pegawai->setFormValue($val);
		}

		// Check field name 'jabatan_pegawai' first before field var 'x_jabatan_pegawai'
		$val = $CurrentForm->hasValue("jabatan_pegawai") ? $CurrentForm->getValue("jabatan_pegawai") : $CurrentForm->getValue("x_jabatan_pegawai");
		if (!$this->jabatan_pegawai->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jabatan_pegawai->Visible = FALSE; // Disable update for API request
			else
				$this->jabatan_pegawai->setFormValue($val);
		}

		// Check field name 'status_pegawai' first before field var 'x_status_pegawai'
		$val = $CurrentForm->hasValue("status_pegawai") ? $CurrentForm->getValue("status_pegawai") : $CurrentForm->getValue("x_status_pegawai");
		if (!$this->status_pegawai->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->status_pegawai->Visible = FALSE; // Disable update for API request
			else
				$this->status_pegawai->setFormValue($val);
		}

		// Check field name 'tarif_pegawai' first before field var 'x_tarif_pegawai'
		$val = $CurrentForm->hasValue("tarif_pegawai") ? $CurrentForm->getValue("tarif_pegawai") : $CurrentForm->getValue("x_tarif_pegawai");
		if (!$this->tarif_pegawai->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tarif_pegawai->Visible = FALSE; // Disable update for API request
			else
				$this->tarif_pegawai->setFormValue($val);
		}

		// Check field name 'id_klinik' first before field var 'x_id_klinik'
		$val = $CurrentForm->hasValue("id_klinik") ? $CurrentForm->getValue("id_klinik") : $CurrentForm->getValue("x_id_klinik");
		if (!$this->id_klinik->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_klinik->Visible = FALSE; // Disable update for API request
			else
				$this->id_klinik->setFormValue($val);
		}

		// Check field name 'id_pegawai' first before field var 'x_id_pegawai'
		$val = $CurrentForm->hasValue("id_pegawai") ? $CurrentForm->getValue("id_pegawai") : $CurrentForm->getValue("x_id_pegawai");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->nama_pegawai->CurrentValue = $this->nama_pegawai->FormValue;
		$this->nama_lengkap->CurrentValue = $this->nama_lengkap->FormValue;
		$this->jenis_pegawai->CurrentValue = $this->jenis_pegawai->FormValue;
		$this->nik_pegawai->CurrentValue = $this->nik_pegawai->FormValue;
		$this->agama_pegawai->CurrentValue = $this->agama_pegawai->FormValue;
		$this->tgllahir_pegawai->CurrentValue = $this->tgllahir_pegawai->FormValue;
		$this->tgllahir_pegawai->CurrentValue = UnFormatDateTime($this->tgllahir_pegawai->CurrentValue, 0);
		$this->alamat_pegawai->CurrentValue = $this->alamat_pegawai->FormValue;
		$this->hp_pegawai->CurrentValue = $this->hp_pegawai->FormValue;
		$this->pendidikan_pegawai->CurrentValue = $this->pendidikan_pegawai->FormValue;
		$this->jurusan_pegawai->CurrentValue = $this->jurusan_pegawai->FormValue;
		$this->spesialis_pegawai->CurrentValue = $this->spesialis_pegawai->FormValue;
		$this->jabatan_pegawai->CurrentValue = $this->jabatan_pegawai->FormValue;
		$this->status_pegawai->CurrentValue = $this->status_pegawai->FormValue;
		$this->tarif_pegawai->CurrentValue = $this->tarif_pegawai->FormValue;
		$this->id_klinik->CurrentValue = $this->id_klinik->FormValue;
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
		$this->id_pegawai->setDbValue($row['id_pegawai']);
		$this->nama_pegawai->setDbValue($row['nama_pegawai']);
		$this->nama_lengkap->setDbValue($row['nama_lengkap']);
		$this->jenis_pegawai->setDbValue($row['jenis_pegawai']);
		$this->nik_pegawai->setDbValue($row['nik_pegawai']);
		$this->agama_pegawai->setDbValue($row['agama_pegawai']);
		$this->tgllahir_pegawai->setDbValue($row['tgllahir_pegawai']);
		$this->alamat_pegawai->setDbValue($row['alamat_pegawai']);
		$this->hp_pegawai->setDbValue($row['hp_pegawai']);
		$this->pendidikan_pegawai->setDbValue($row['pendidikan_pegawai']);
		$this->jurusan_pegawai->setDbValue($row['jurusan_pegawai']);
		$this->spesialis_pegawai->setDbValue($row['spesialis_pegawai']);
		$this->jabatan_pegawai->setDbValue($row['jabatan_pegawai']);
		$this->status_pegawai->setDbValue($row['status_pegawai']);
		$this->tarif_pegawai->setDbValue($row['tarif_pegawai']);
		$this->id_klinik->setDbValue($row['id_klinik']);
		$this->target->setDbValue($row['target']);
		$this->nilai_komisi->setDbValue($row['nilai_komisi']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id_pegawai'] = $this->id_pegawai->CurrentValue;
		$row['nama_pegawai'] = $this->nama_pegawai->CurrentValue;
		$row['nama_lengkap'] = $this->nama_lengkap->CurrentValue;
		$row['jenis_pegawai'] = $this->jenis_pegawai->CurrentValue;
		$row['nik_pegawai'] = $this->nik_pegawai->CurrentValue;
		$row['agama_pegawai'] = $this->agama_pegawai->CurrentValue;
		$row['tgllahir_pegawai'] = $this->tgllahir_pegawai->CurrentValue;
		$row['alamat_pegawai'] = $this->alamat_pegawai->CurrentValue;
		$row['hp_pegawai'] = $this->hp_pegawai->CurrentValue;
		$row['pendidikan_pegawai'] = $this->pendidikan_pegawai->CurrentValue;
		$row['jurusan_pegawai'] = $this->jurusan_pegawai->CurrentValue;
		$row['spesialis_pegawai'] = $this->spesialis_pegawai->CurrentValue;
		$row['jabatan_pegawai'] = $this->jabatan_pegawai->CurrentValue;
		$row['status_pegawai'] = $this->status_pegawai->CurrentValue;
		$row['tarif_pegawai'] = $this->tarif_pegawai->CurrentValue;
		$row['id_klinik'] = $this->id_klinik->CurrentValue;
		$row['target'] = $this->target->CurrentValue;
		$row['nilai_komisi'] = $this->nilai_komisi->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id_pegawai")) != "")
			$this->id_pegawai->OldValue = $this->getKey("id_pegawai"); // id_pegawai
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
		// id_pegawai
		// nama_pegawai
		// nama_lengkap
		// jenis_pegawai
		// nik_pegawai
		// agama_pegawai
		// tgllahir_pegawai
		// alamat_pegawai
		// hp_pegawai
		// pendidikan_pegawai
		// jurusan_pegawai
		// spesialis_pegawai
		// jabatan_pegawai
		// status_pegawai
		// tarif_pegawai
		// id_klinik
		// target
		// nilai_komisi

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id_pegawai
			$this->id_pegawai->ViewValue = $this->id_pegawai->CurrentValue;
			$this->id_pegawai->ViewCustomAttributes = "";

			// nama_pegawai
			$this->nama_pegawai->ViewValue = $this->nama_pegawai->CurrentValue;
			$this->nama_pegawai->ViewCustomAttributes = "";

			// nama_lengkap
			$this->nama_lengkap->ViewValue = $this->nama_lengkap->CurrentValue;
			$this->nama_lengkap->ViewCustomAttributes = "";

			// jenis_pegawai
			if (strval($this->jenis_pegawai->CurrentValue) != "") {
				$this->jenis_pegawai->ViewValue = $this->jenis_pegawai->optionCaption($this->jenis_pegawai->CurrentValue);
			} else {
				$this->jenis_pegawai->ViewValue = NULL;
			}
			$this->jenis_pegawai->ViewCustomAttributes = "";

			// nik_pegawai
			$this->nik_pegawai->ViewValue = $this->nik_pegawai->CurrentValue;
			$this->nik_pegawai->ViewCustomAttributes = "";

			// agama_pegawai
			$curVal = strval($this->agama_pegawai->CurrentValue);
			if ($curVal != "") {
				$this->agama_pegawai->ViewValue = $this->agama_pegawai->lookupCacheOption($curVal);
				if ($this->agama_pegawai->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_agama`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->agama_pegawai->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->agama_pegawai->ViewValue = $this->agama_pegawai->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->agama_pegawai->ViewValue = $this->agama_pegawai->CurrentValue;
					}
				}
			} else {
				$this->agama_pegawai->ViewValue = NULL;
			}
			$this->agama_pegawai->ViewCustomAttributes = "";

			// tgllahir_pegawai
			$this->tgllahir_pegawai->ViewValue = $this->tgllahir_pegawai->CurrentValue;
			$this->tgllahir_pegawai->ViewValue = FormatDateTime($this->tgllahir_pegawai->ViewValue, 0);
			$this->tgllahir_pegawai->ViewCustomAttributes = "";

			// alamat_pegawai
			$this->alamat_pegawai->ViewValue = $this->alamat_pegawai->CurrentValue;
			$this->alamat_pegawai->ViewCustomAttributes = "";

			// hp_pegawai
			$this->hp_pegawai->ViewValue = $this->hp_pegawai->CurrentValue;
			$this->hp_pegawai->ViewCustomAttributes = "";

			// pendidikan_pegawai
			$this->pendidikan_pegawai->ViewValue = $this->pendidikan_pegawai->CurrentValue;
			$this->pendidikan_pegawai->ViewCustomAttributes = "";

			// jurusan_pegawai
			$this->jurusan_pegawai->ViewValue = $this->jurusan_pegawai->CurrentValue;
			$this->jurusan_pegawai->ViewCustomAttributes = "";

			// spesialis_pegawai
			$this->spesialis_pegawai->ViewValue = $this->spesialis_pegawai->CurrentValue;
			$this->spesialis_pegawai->ViewCustomAttributes = "";

			// jabatan_pegawai
			$curVal = strval($this->jabatan_pegawai->CurrentValue);
			if ($curVal != "") {
				$this->jabatan_pegawai->ViewValue = $this->jabatan_pegawai->lookupCacheOption($curVal);
				if ($this->jabatan_pegawai->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->jabatan_pegawai->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->jabatan_pegawai->ViewValue = $this->jabatan_pegawai->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->jabatan_pegawai->ViewValue = $this->jabatan_pegawai->CurrentValue;
					}
				}
			} else {
				$this->jabatan_pegawai->ViewValue = NULL;
			}
			$this->jabatan_pegawai->ViewCustomAttributes = "";

			// status_pegawai
			if (strval($this->status_pegawai->CurrentValue) != "") {
				$this->status_pegawai->ViewValue = $this->status_pegawai->optionCaption($this->status_pegawai->CurrentValue);
			} else {
				$this->status_pegawai->ViewValue = NULL;
			}
			$this->status_pegawai->ViewCustomAttributes = "";

			// tarif_pegawai
			$this->tarif_pegawai->ViewValue = $this->tarif_pegawai->CurrentValue;
			$this->tarif_pegawai->ViewValue = FormatNumber($this->tarif_pegawai->ViewValue, 0, -2, -2, -2);
			$this->tarif_pegawai->ViewCustomAttributes = "";

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

			// target
			$this->target->ViewValue = $this->target->CurrentValue;
			$this->target->ViewValue = FormatNumber($this->target->ViewValue, 0, -2, -2, -2);
			$this->target->ViewCustomAttributes = "";

			// nilai_komisi
			$this->nilai_komisi->ViewValue = $this->nilai_komisi->CurrentValue;
			$this->nilai_komisi->ViewValue = FormatNumber($this->nilai_komisi->ViewValue, 0, -2, -2, -2);
			$this->nilai_komisi->ViewCustomAttributes = "";

			// nama_pegawai
			$this->nama_pegawai->LinkCustomAttributes = "";
			$this->nama_pegawai->HrefValue = "";
			$this->nama_pegawai->TooltipValue = "";

			// nama_lengkap
			$this->nama_lengkap->LinkCustomAttributes = "";
			$this->nama_lengkap->HrefValue = "";
			$this->nama_lengkap->TooltipValue = "";

			// jenis_pegawai
			$this->jenis_pegawai->LinkCustomAttributes = "";
			$this->jenis_pegawai->HrefValue = "";
			$this->jenis_pegawai->TooltipValue = "";

			// nik_pegawai
			$this->nik_pegawai->LinkCustomAttributes = "";
			$this->nik_pegawai->HrefValue = "";
			$this->nik_pegawai->TooltipValue = "";

			// agama_pegawai
			$this->agama_pegawai->LinkCustomAttributes = "";
			$this->agama_pegawai->HrefValue = "";
			$this->agama_pegawai->TooltipValue = "";

			// tgllahir_pegawai
			$this->tgllahir_pegawai->LinkCustomAttributes = "";
			$this->tgllahir_pegawai->HrefValue = "";
			$this->tgllahir_pegawai->TooltipValue = "";

			// alamat_pegawai
			$this->alamat_pegawai->LinkCustomAttributes = "";
			$this->alamat_pegawai->HrefValue = "";
			$this->alamat_pegawai->TooltipValue = "";

			// hp_pegawai
			$this->hp_pegawai->LinkCustomAttributes = "";
			$this->hp_pegawai->HrefValue = "";
			$this->hp_pegawai->TooltipValue = "";

			// pendidikan_pegawai
			$this->pendidikan_pegawai->LinkCustomAttributes = "";
			$this->pendidikan_pegawai->HrefValue = "";
			$this->pendidikan_pegawai->TooltipValue = "";

			// jurusan_pegawai
			$this->jurusan_pegawai->LinkCustomAttributes = "";
			$this->jurusan_pegawai->HrefValue = "";
			$this->jurusan_pegawai->TooltipValue = "";

			// spesialis_pegawai
			$this->spesialis_pegawai->LinkCustomAttributes = "";
			$this->spesialis_pegawai->HrefValue = "";
			$this->spesialis_pegawai->TooltipValue = "";

			// jabatan_pegawai
			$this->jabatan_pegawai->LinkCustomAttributes = "";
			$this->jabatan_pegawai->HrefValue = "";
			$this->jabatan_pegawai->TooltipValue = "";

			// status_pegawai
			$this->status_pegawai->LinkCustomAttributes = "";
			$this->status_pegawai->HrefValue = "";
			$this->status_pegawai->TooltipValue = "";

			// tarif_pegawai
			$this->tarif_pegawai->LinkCustomAttributes = "";
			$this->tarif_pegawai->HrefValue = "";
			$this->tarif_pegawai->TooltipValue = "";

			// id_klinik
			$this->id_klinik->LinkCustomAttributes = "";
			$this->id_klinik->HrefValue = "";
			$this->id_klinik->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// nama_pegawai
			$this->nama_pegawai->EditAttrs["class"] = "form-control";
			$this->nama_pegawai->EditCustomAttributes = "";
			if (!$this->nama_pegawai->Raw)
				$this->nama_pegawai->CurrentValue = HtmlDecode($this->nama_pegawai->CurrentValue);
			$this->nama_pegawai->EditValue = HtmlEncode($this->nama_pegawai->CurrentValue);
			$this->nama_pegawai->PlaceHolder = RemoveHtml($this->nama_pegawai->caption());

			// nama_lengkap
			$this->nama_lengkap->EditAttrs["class"] = "form-control";
			$this->nama_lengkap->EditCustomAttributes = "";
			if (!$this->nama_lengkap->Raw)
				$this->nama_lengkap->CurrentValue = HtmlDecode($this->nama_lengkap->CurrentValue);
			$this->nama_lengkap->EditValue = HtmlEncode($this->nama_lengkap->CurrentValue);
			$this->nama_lengkap->PlaceHolder = RemoveHtml($this->nama_lengkap->caption());

			// jenis_pegawai
			$this->jenis_pegawai->EditCustomAttributes = "";
			$this->jenis_pegawai->EditValue = $this->jenis_pegawai->options(FALSE);

			// nik_pegawai
			$this->nik_pegawai->EditAttrs["class"] = "form-control";
			$this->nik_pegawai->EditCustomAttributes = "";
			if (!$this->nik_pegawai->Raw)
				$this->nik_pegawai->CurrentValue = HtmlDecode($this->nik_pegawai->CurrentValue);
			$this->nik_pegawai->EditValue = HtmlEncode($this->nik_pegawai->CurrentValue);
			$this->nik_pegawai->PlaceHolder = RemoveHtml($this->nik_pegawai->caption());

			// agama_pegawai
			$this->agama_pegawai->EditAttrs["class"] = "form-control";
			$this->agama_pegawai->EditCustomAttributes = "";
			$curVal = trim(strval($this->agama_pegawai->CurrentValue));
			if ($curVal != "")
				$this->agama_pegawai->ViewValue = $this->agama_pegawai->lookupCacheOption($curVal);
			else
				$this->agama_pegawai->ViewValue = $this->agama_pegawai->Lookup !== NULL && is_array($this->agama_pegawai->Lookup->Options) ? $curVal : NULL;
			if ($this->agama_pegawai->ViewValue !== NULL) { // Load from cache
				$this->agama_pegawai->EditValue = array_values($this->agama_pegawai->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_agama`" . SearchString("=", $this->agama_pegawai->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->agama_pegawai->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->agama_pegawai->EditValue = $arwrk;
			}

			// tgllahir_pegawai
			$this->tgllahir_pegawai->EditAttrs["class"] = "form-control";
			$this->tgllahir_pegawai->EditCustomAttributes = "";
			$this->tgllahir_pegawai->EditValue = HtmlEncode(FormatDateTime($this->tgllahir_pegawai->CurrentValue, 8));
			$this->tgllahir_pegawai->PlaceHolder = RemoveHtml($this->tgllahir_pegawai->caption());

			// alamat_pegawai
			$this->alamat_pegawai->EditAttrs["class"] = "form-control";
			$this->alamat_pegawai->EditCustomAttributes = "";
			if (!$this->alamat_pegawai->Raw)
				$this->alamat_pegawai->CurrentValue = HtmlDecode($this->alamat_pegawai->CurrentValue);
			$this->alamat_pegawai->EditValue = HtmlEncode($this->alamat_pegawai->CurrentValue);
			$this->alamat_pegawai->PlaceHolder = RemoveHtml($this->alamat_pegawai->caption());

			// hp_pegawai
			$this->hp_pegawai->EditAttrs["class"] = "form-control";
			$this->hp_pegawai->EditCustomAttributes = "";
			if (!$this->hp_pegawai->Raw)
				$this->hp_pegawai->CurrentValue = HtmlDecode($this->hp_pegawai->CurrentValue);
			$this->hp_pegawai->EditValue = HtmlEncode($this->hp_pegawai->CurrentValue);
			$this->hp_pegawai->PlaceHolder = RemoveHtml($this->hp_pegawai->caption());

			// pendidikan_pegawai
			$this->pendidikan_pegawai->EditAttrs["class"] = "form-control";
			$this->pendidikan_pegawai->EditCustomAttributes = "";
			if (!$this->pendidikan_pegawai->Raw)
				$this->pendidikan_pegawai->CurrentValue = HtmlDecode($this->pendidikan_pegawai->CurrentValue);
			$this->pendidikan_pegawai->EditValue = HtmlEncode($this->pendidikan_pegawai->CurrentValue);
			$this->pendidikan_pegawai->PlaceHolder = RemoveHtml($this->pendidikan_pegawai->caption());

			// jurusan_pegawai
			$this->jurusan_pegawai->EditAttrs["class"] = "form-control";
			$this->jurusan_pegawai->EditCustomAttributes = "";
			if (!$this->jurusan_pegawai->Raw)
				$this->jurusan_pegawai->CurrentValue = HtmlDecode($this->jurusan_pegawai->CurrentValue);
			$this->jurusan_pegawai->EditValue = HtmlEncode($this->jurusan_pegawai->CurrentValue);
			$this->jurusan_pegawai->PlaceHolder = RemoveHtml($this->jurusan_pegawai->caption());

			// spesialis_pegawai
			$this->spesialis_pegawai->EditAttrs["class"] = "form-control";
			$this->spesialis_pegawai->EditCustomAttributes = "";
			if (!$this->spesialis_pegawai->Raw)
				$this->spesialis_pegawai->CurrentValue = HtmlDecode($this->spesialis_pegawai->CurrentValue);
			$this->spesialis_pegawai->EditValue = HtmlEncode($this->spesialis_pegawai->CurrentValue);
			$this->spesialis_pegawai->PlaceHolder = RemoveHtml($this->spesialis_pegawai->caption());

			// jabatan_pegawai
			$this->jabatan_pegawai->EditAttrs["class"] = "form-control";
			$this->jabatan_pegawai->EditCustomAttributes = "";
			$curVal = trim(strval($this->jabatan_pegawai->CurrentValue));
			if ($curVal != "")
				$this->jabatan_pegawai->ViewValue = $this->jabatan_pegawai->lookupCacheOption($curVal);
			else
				$this->jabatan_pegawai->ViewValue = $this->jabatan_pegawai->Lookup !== NULL && is_array($this->jabatan_pegawai->Lookup->Options) ? $curVal : NULL;
			if ($this->jabatan_pegawai->ViewValue !== NULL) { // Load from cache
				$this->jabatan_pegawai->EditValue = array_values($this->jabatan_pegawai->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->jabatan_pegawai->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->jabatan_pegawai->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->jabatan_pegawai->EditValue = $arwrk;
			}

			// status_pegawai
			$this->status_pegawai->EditCustomAttributes = "";
			$this->status_pegawai->EditValue = $this->status_pegawai->options(FALSE);

			// tarif_pegawai
			$this->tarif_pegawai->EditAttrs["class"] = "form-control";
			$this->tarif_pegawai->EditCustomAttributes = "";
			$this->tarif_pegawai->EditValue = HtmlEncode($this->tarif_pegawai->CurrentValue);
			$this->tarif_pegawai->PlaceHolder = RemoveHtml($this->tarif_pegawai->caption());

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

			// Add refer script
			// nama_pegawai

			$this->nama_pegawai->LinkCustomAttributes = "";
			$this->nama_pegawai->HrefValue = "";

			// nama_lengkap
			$this->nama_lengkap->LinkCustomAttributes = "";
			$this->nama_lengkap->HrefValue = "";

			// jenis_pegawai
			$this->jenis_pegawai->LinkCustomAttributes = "";
			$this->jenis_pegawai->HrefValue = "";

			// nik_pegawai
			$this->nik_pegawai->LinkCustomAttributes = "";
			$this->nik_pegawai->HrefValue = "";

			// agama_pegawai
			$this->agama_pegawai->LinkCustomAttributes = "";
			$this->agama_pegawai->HrefValue = "";

			// tgllahir_pegawai
			$this->tgllahir_pegawai->LinkCustomAttributes = "";
			$this->tgllahir_pegawai->HrefValue = "";

			// alamat_pegawai
			$this->alamat_pegawai->LinkCustomAttributes = "";
			$this->alamat_pegawai->HrefValue = "";

			// hp_pegawai
			$this->hp_pegawai->LinkCustomAttributes = "";
			$this->hp_pegawai->HrefValue = "";

			// pendidikan_pegawai
			$this->pendidikan_pegawai->LinkCustomAttributes = "";
			$this->pendidikan_pegawai->HrefValue = "";

			// jurusan_pegawai
			$this->jurusan_pegawai->LinkCustomAttributes = "";
			$this->jurusan_pegawai->HrefValue = "";

			// spesialis_pegawai
			$this->spesialis_pegawai->LinkCustomAttributes = "";
			$this->spesialis_pegawai->HrefValue = "";

			// jabatan_pegawai
			$this->jabatan_pegawai->LinkCustomAttributes = "";
			$this->jabatan_pegawai->HrefValue = "";

			// status_pegawai
			$this->status_pegawai->LinkCustomAttributes = "";
			$this->status_pegawai->HrefValue = "";

			// tarif_pegawai
			$this->tarif_pegawai->LinkCustomAttributes = "";
			$this->tarif_pegawai->HrefValue = "";

			// id_klinik
			$this->id_klinik->LinkCustomAttributes = "";
			$this->id_klinik->HrefValue = "";
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
		if ($this->nama_pegawai->Required) {
			if (!$this->nama_pegawai->IsDetailKey && $this->nama_pegawai->FormValue != NULL && $this->nama_pegawai->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nama_pegawai->caption(), $this->nama_pegawai->RequiredErrorMessage));
			}
		}
		if ($this->nama_lengkap->Required) {
			if (!$this->nama_lengkap->IsDetailKey && $this->nama_lengkap->FormValue != NULL && $this->nama_lengkap->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nama_lengkap->caption(), $this->nama_lengkap->RequiredErrorMessage));
			}
		}
		if ($this->jenis_pegawai->Required) {
			if ($this->jenis_pegawai->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jenis_pegawai->caption(), $this->jenis_pegawai->RequiredErrorMessage));
			}
		}
		if ($this->nik_pegawai->Required) {
			if (!$this->nik_pegawai->IsDetailKey && $this->nik_pegawai->FormValue != NULL && $this->nik_pegawai->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nik_pegawai->caption(), $this->nik_pegawai->RequiredErrorMessage));
			}
		}
		if ($this->agama_pegawai->Required) {
			if (!$this->agama_pegawai->IsDetailKey && $this->agama_pegawai->FormValue != NULL && $this->agama_pegawai->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->agama_pegawai->caption(), $this->agama_pegawai->RequiredErrorMessage));
			}
		}
		if ($this->tgllahir_pegawai->Required) {
			if (!$this->tgllahir_pegawai->IsDetailKey && $this->tgllahir_pegawai->FormValue != NULL && $this->tgllahir_pegawai->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgllahir_pegawai->caption(), $this->tgllahir_pegawai->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tgllahir_pegawai->FormValue)) {
			AddMessage($FormError, $this->tgllahir_pegawai->errorMessage());
		}
		if ($this->alamat_pegawai->Required) {
			if (!$this->alamat_pegawai->IsDetailKey && $this->alamat_pegawai->FormValue != NULL && $this->alamat_pegawai->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->alamat_pegawai->caption(), $this->alamat_pegawai->RequiredErrorMessage));
			}
		}
		if ($this->hp_pegawai->Required) {
			if (!$this->hp_pegawai->IsDetailKey && $this->hp_pegawai->FormValue != NULL && $this->hp_pegawai->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->hp_pegawai->caption(), $this->hp_pegawai->RequiredErrorMessage));
			}
		}
		if ($this->pendidikan_pegawai->Required) {
			if (!$this->pendidikan_pegawai->IsDetailKey && $this->pendidikan_pegawai->FormValue != NULL && $this->pendidikan_pegawai->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->pendidikan_pegawai->caption(), $this->pendidikan_pegawai->RequiredErrorMessage));
			}
		}
		if ($this->jurusan_pegawai->Required) {
			if (!$this->jurusan_pegawai->IsDetailKey && $this->jurusan_pegawai->FormValue != NULL && $this->jurusan_pegawai->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jurusan_pegawai->caption(), $this->jurusan_pegawai->RequiredErrorMessage));
			}
		}
		if ($this->spesialis_pegawai->Required) {
			if (!$this->spesialis_pegawai->IsDetailKey && $this->spesialis_pegawai->FormValue != NULL && $this->spesialis_pegawai->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->spesialis_pegawai->caption(), $this->spesialis_pegawai->RequiredErrorMessage));
			}
		}
		if ($this->jabatan_pegawai->Required) {
			if (!$this->jabatan_pegawai->IsDetailKey && $this->jabatan_pegawai->FormValue != NULL && $this->jabatan_pegawai->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jabatan_pegawai->caption(), $this->jabatan_pegawai->RequiredErrorMessage));
			}
		}
		if ($this->status_pegawai->Required) {
			if ($this->status_pegawai->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->status_pegawai->caption(), $this->status_pegawai->RequiredErrorMessage));
			}
		}
		if ($this->tarif_pegawai->Required) {
			if (!$this->tarif_pegawai->IsDetailKey && $this->tarif_pegawai->FormValue != NULL && $this->tarif_pegawai->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tarif_pegawai->caption(), $this->tarif_pegawai->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->tarif_pegawai->FormValue)) {
			AddMessage($FormError, $this->tarif_pegawai->errorMessage());
		}
		if ($this->id_klinik->Required) {
			if (!$this->id_klinik->IsDetailKey && $this->id_klinik->FormValue != NULL && $this->id_klinik->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_klinik->caption(), $this->id_klinik->RequiredErrorMessage));
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

		// nama_pegawai
		$this->nama_pegawai->setDbValueDef($rsnew, $this->nama_pegawai->CurrentValue, NULL, FALSE);

		// nama_lengkap
		$this->nama_lengkap->setDbValueDef($rsnew, $this->nama_lengkap->CurrentValue, NULL, FALSE);

		// jenis_pegawai
		$this->jenis_pegawai->setDbValueDef($rsnew, $this->jenis_pegawai->CurrentValue, NULL, FALSE);

		// nik_pegawai
		$this->nik_pegawai->setDbValueDef($rsnew, $this->nik_pegawai->CurrentValue, NULL, FALSE);

		// agama_pegawai
		$this->agama_pegawai->setDbValueDef($rsnew, $this->agama_pegawai->CurrentValue, NULL, FALSE);

		// tgllahir_pegawai
		$this->tgllahir_pegawai->setDbValueDef($rsnew, UnFormatDateTime($this->tgllahir_pegawai->CurrentValue, 0), NULL, FALSE);

		// alamat_pegawai
		$this->alamat_pegawai->setDbValueDef($rsnew, $this->alamat_pegawai->CurrentValue, NULL, FALSE);

		// hp_pegawai
		$this->hp_pegawai->setDbValueDef($rsnew, $this->hp_pegawai->CurrentValue, NULL, FALSE);

		// pendidikan_pegawai
		$this->pendidikan_pegawai->setDbValueDef($rsnew, $this->pendidikan_pegawai->CurrentValue, NULL, FALSE);

		// jurusan_pegawai
		$this->jurusan_pegawai->setDbValueDef($rsnew, $this->jurusan_pegawai->CurrentValue, NULL, FALSE);

		// spesialis_pegawai
		$this->spesialis_pegawai->setDbValueDef($rsnew, $this->spesialis_pegawai->CurrentValue, NULL, FALSE);

		// jabatan_pegawai
		$this->jabatan_pegawai->setDbValueDef($rsnew, $this->jabatan_pegawai->CurrentValue, NULL, FALSE);

		// status_pegawai
		$this->status_pegawai->setDbValueDef($rsnew, $this->status_pegawai->CurrentValue, NULL, FALSE);

		// tarif_pegawai
		$this->tarif_pegawai->setDbValueDef($rsnew, $this->tarif_pegawai->CurrentValue, NULL, FALSE);

		// id_klinik
		$this->id_klinik->setDbValueDef($rsnew, $this->id_klinik->CurrentValue, NULL, FALSE);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("m_pegawailist.php"), "", $this->TableVar, TRUE);
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
				case "x_jenis_pegawai":
					break;
				case "x_agama_pegawai":
					break;
				case "x_jabatan_pegawai":
					break;
				case "x_status_pegawai":
					break;
				case "x_id_klinik":
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
						case "x_agama_pegawai":
							break;
						case "x_jabatan_pegawai":
							break;
						case "x_id_klinik":
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