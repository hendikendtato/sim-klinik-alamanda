<?php
namespace PHPMaker2020\sim_klinik_alamanda;

/**
 * Page class
 */
class m_hargajual_edit extends m_hargajual
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{8546B030-7993-4749-BFDB-17AFAAF4065D}";

	// Table name
	public $TableName = 'm_hargajual';

	// Page object name
	public $PageObjName = "m_hargajual_edit";

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

		// Table object (m_hargajual)
		if (!isset($GLOBALS["m_hargajual"]) || get_class($GLOBALS["m_hargajual"]) == PROJECT_NAMESPACE . "m_hargajual") {
			$GLOBALS["m_hargajual"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["m_hargajual"];
		}

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'm_hargajual');

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
		global $m_hargajual;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($m_hargajual);
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
					if ($pageName == "m_hargajualview.php")
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
			$key .= @$ar['id_hargajual'];
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
			$this->id_hargajual->Visible = FALSE;
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
					$this->terminate(GetUrl("m_hargajuallist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id_hargajual->Visible = FALSE;
		$this->id_barang->setVisibility();
		$this->totalhargajual->setVisibility();
		$this->disc_pr->setVisibility();
		$this->disc_rp->setVisibility();
		$this->id_klinik->setVisibility();
		$this->stok->setVisibility();
		$this->satuan->setVisibility();
		$this->minimum_stok->setVisibility();
		$this->tgl_masuk->setVisibility();
		$this->tgl_exp->setVisibility();
		$this->kategori->setVisibility();
		$this->subkategori->setVisibility();
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
		$this->setupLookupOptions($this->id_klinik);
		$this->setupLookupOptions($this->satuan);
		$this->setupLookupOptions($this->kategori);
		$this->setupLookupOptions($this->subkategori);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("m_hargajuallist.php");
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
			if (Get("id_hargajual") !== NULL) {
				$this->id_hargajual->setQueryStringValue(Get("id_hargajual"));
				$this->id_hargajual->setOldValue($this->id_hargajual->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->id_hargajual->setQueryStringValue(Key(0));
				$this->id_hargajual->setOldValue($this->id_hargajual->QueryStringValue);
			} elseif (Post("id_hargajual") !== NULL) {
				$this->id_hargajual->setFormValue(Post("id_hargajual"));
				$this->id_hargajual->setOldValue($this->id_hargajual->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->id_hargajual->setQueryStringValue(Route(2));
				$this->id_hargajual->setOldValue($this->id_hargajual->QueryStringValue);
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
				if ($CurrentForm->hasValue("x_id_hargajual")) {
					$this->id_hargajual->setFormValue($CurrentForm->getValue("x_id_hargajual"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("id_hargajual") !== NULL) {
					$this->id_hargajual->setQueryStringValue(Get("id_hargajual"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->id_hargajual->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->id_hargajual->CurrentValue = NULL;
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
					$this->terminate("m_hargajuallist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "m_hargajuallist.php")
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

		// Check field name 'id_barang' first before field var 'x_id_barang'
		$val = $CurrentForm->hasValue("id_barang") ? $CurrentForm->getValue("id_barang") : $CurrentForm->getValue("x_id_barang");
		if (!$this->id_barang->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_barang->Visible = FALSE; // Disable update for API request
			else
				$this->id_barang->setFormValue($val);
		}

		// Check field name 'totalhargajual' first before field var 'x_totalhargajual'
		$val = $CurrentForm->hasValue("totalhargajual") ? $CurrentForm->getValue("totalhargajual") : $CurrentForm->getValue("x_totalhargajual");
		if (!$this->totalhargajual->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->totalhargajual->Visible = FALSE; // Disable update for API request
			else
				$this->totalhargajual->setFormValue($val);
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

		// Check field name 'id_klinik' first before field var 'x_id_klinik'
		$val = $CurrentForm->hasValue("id_klinik") ? $CurrentForm->getValue("id_klinik") : $CurrentForm->getValue("x_id_klinik");
		if (!$this->id_klinik->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_klinik->Visible = FALSE; // Disable update for API request
			else
				$this->id_klinik->setFormValue($val);
		}

		// Check field name 'stok' first before field var 'x_stok'
		$val = $CurrentForm->hasValue("stok") ? $CurrentForm->getValue("stok") : $CurrentForm->getValue("x_stok");
		if (!$this->stok->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->stok->Visible = FALSE; // Disable update for API request
			else
				$this->stok->setFormValue($val);
		}

		// Check field name 'satuan' first before field var 'x_satuan'
		$val = $CurrentForm->hasValue("satuan") ? $CurrentForm->getValue("satuan") : $CurrentForm->getValue("x_satuan");
		if (!$this->satuan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->satuan->Visible = FALSE; // Disable update for API request
			else
				$this->satuan->setFormValue($val);
		}

		// Check field name 'minimum_stok' first before field var 'x_minimum_stok'
		$val = $CurrentForm->hasValue("minimum_stok") ? $CurrentForm->getValue("minimum_stok") : $CurrentForm->getValue("x_minimum_stok");
		if (!$this->minimum_stok->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->minimum_stok->Visible = FALSE; // Disable update for API request
			else
				$this->minimum_stok->setFormValue($val);
		}

		// Check field name 'tgl_masuk' first before field var 'x_tgl_masuk'
		$val = $CurrentForm->hasValue("tgl_masuk") ? $CurrentForm->getValue("tgl_masuk") : $CurrentForm->getValue("x_tgl_masuk");
		if (!$this->tgl_masuk->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tgl_masuk->Visible = FALSE; // Disable update for API request
			else
				$this->tgl_masuk->setFormValue($val);
			$this->tgl_masuk->CurrentValue = UnFormatDateTime($this->tgl_masuk->CurrentValue, 0);
		}

		// Check field name 'tgl_exp' first before field var 'x_tgl_exp'
		$val = $CurrentForm->hasValue("tgl_exp") ? $CurrentForm->getValue("tgl_exp") : $CurrentForm->getValue("x_tgl_exp");
		if (!$this->tgl_exp->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tgl_exp->Visible = FALSE; // Disable update for API request
			else
				$this->tgl_exp->setFormValue($val);
			$this->tgl_exp->CurrentValue = UnFormatDateTime($this->tgl_exp->CurrentValue, 0);
		}

		// Check field name 'kategori' first before field var 'x_kategori'
		$val = $CurrentForm->hasValue("kategori") ? $CurrentForm->getValue("kategori") : $CurrentForm->getValue("x_kategori");
		if (!$this->kategori->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->kategori->Visible = FALSE; // Disable update for API request
			else
				$this->kategori->setFormValue($val);
		}

		// Check field name 'subkategori' first before field var 'x_subkategori'
		$val = $CurrentForm->hasValue("subkategori") ? $CurrentForm->getValue("subkategori") : $CurrentForm->getValue("x_subkategori");
		if (!$this->subkategori->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->subkategori->Visible = FALSE; // Disable update for API request
			else
				$this->subkategori->setFormValue($val);
		}

		// Check field name 'id_hargajual' first before field var 'x_id_hargajual'
		$val = $CurrentForm->hasValue("id_hargajual") ? $CurrentForm->getValue("id_hargajual") : $CurrentForm->getValue("x_id_hargajual");
		if (!$this->id_hargajual->IsDetailKey)
			$this->id_hargajual->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id_hargajual->CurrentValue = $this->id_hargajual->FormValue;
		$this->id_barang->CurrentValue = $this->id_barang->FormValue;
		$this->totalhargajual->CurrentValue = $this->totalhargajual->FormValue;
		$this->disc_pr->CurrentValue = $this->disc_pr->FormValue;
		$this->disc_rp->CurrentValue = $this->disc_rp->FormValue;
		$this->id_klinik->CurrentValue = $this->id_klinik->FormValue;
		$this->stok->CurrentValue = $this->stok->FormValue;
		$this->satuan->CurrentValue = $this->satuan->FormValue;
		$this->minimum_stok->CurrentValue = $this->minimum_stok->FormValue;
		$this->tgl_masuk->CurrentValue = $this->tgl_masuk->FormValue;
		$this->tgl_masuk->CurrentValue = UnFormatDateTime($this->tgl_masuk->CurrentValue, 0);
		$this->tgl_exp->CurrentValue = $this->tgl_exp->FormValue;
		$this->tgl_exp->CurrentValue = UnFormatDateTime($this->tgl_exp->CurrentValue, 0);
		$this->kategori->CurrentValue = $this->kategori->FormValue;
		$this->subkategori->CurrentValue = $this->subkategori->FormValue;
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
		$this->id_hargajual->setDbValue($row['id_hargajual']);
		$this->id_barang->setDbValue($row['id_barang']);
		$this->totalhargajual->setDbValue($row['totalhargajual']);
		$this->disc_pr->setDbValue($row['disc_pr']);
		$this->disc_rp->setDbValue($row['disc_rp']);
		$this->id_klinik->setDbValue($row['id_klinik']);
		$this->stok->setDbValue($row['stok']);
		$this->satuan->setDbValue($row['satuan']);
		$this->minimum_stok->setDbValue($row['minimum_stok']);
		$this->tgl_masuk->setDbValue($row['tgl_masuk']);
		$this->tgl_exp->setDbValue($row['tgl_exp']);
		$this->kategori->setDbValue($row['kategori']);
		$this->subkategori->setDbValue($row['subkategori']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id_hargajual'] = NULL;
		$row['id_barang'] = NULL;
		$row['totalhargajual'] = NULL;
		$row['disc_pr'] = NULL;
		$row['disc_rp'] = NULL;
		$row['id_klinik'] = NULL;
		$row['stok'] = NULL;
		$row['satuan'] = NULL;
		$row['minimum_stok'] = NULL;
		$row['tgl_masuk'] = NULL;
		$row['tgl_exp'] = NULL;
		$row['kategori'] = NULL;
		$row['subkategori'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id_hargajual")) != "")
			$this->id_hargajual->OldValue = $this->getKey("id_hargajual"); // id_hargajual
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

		if ($this->totalhargajual->FormValue == $this->totalhargajual->CurrentValue && is_numeric(ConvertToFloatString($this->totalhargajual->CurrentValue)))
			$this->totalhargajual->CurrentValue = ConvertToFloatString($this->totalhargajual->CurrentValue);

		// Convert decimal values if posted back
		if ($this->disc_pr->FormValue == $this->disc_pr->CurrentValue && is_numeric(ConvertToFloatString($this->disc_pr->CurrentValue)))
			$this->disc_pr->CurrentValue = ConvertToFloatString($this->disc_pr->CurrentValue);

		// Convert decimal values if posted back
		if ($this->disc_rp->FormValue == $this->disc_rp->CurrentValue && is_numeric(ConvertToFloatString($this->disc_rp->CurrentValue)))
			$this->disc_rp->CurrentValue = ConvertToFloatString($this->disc_rp->CurrentValue);

		// Convert decimal values if posted back
		if ($this->stok->FormValue == $this->stok->CurrentValue && is_numeric(ConvertToFloatString($this->stok->CurrentValue)))
			$this->stok->CurrentValue = ConvertToFloatString($this->stok->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id_hargajual
		// id_barang
		// totalhargajual
		// disc_pr
		// disc_rp
		// id_klinik
		// stok
		// satuan
		// minimum_stok
		// tgl_masuk
		// tgl_exp
		// kategori
		// subkategori

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id_hargajual
			$this->id_hargajual->ViewValue = $this->id_hargajual->CurrentValue;
			$this->id_hargajual->ViewCustomAttributes = "";

			// id_barang
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

			// totalhargajual
			$this->totalhargajual->ViewValue = $this->totalhargajual->CurrentValue;
			$this->totalhargajual->ViewValue = FormatNumber($this->totalhargajual->ViewValue, 0, -2, -2, -2);
			$this->totalhargajual->ViewCustomAttributes = "";

			// disc_pr
			$this->disc_pr->ViewValue = $this->disc_pr->CurrentValue;
			$this->disc_pr->ViewValue = FormatNumber($this->disc_pr->ViewValue, 2, -2, -2, -2);
			$this->disc_pr->ViewCustomAttributes = "";

			// disc_rp
			$this->disc_rp->ViewValue = $this->disc_rp->CurrentValue;
			$this->disc_rp->ViewValue = FormatNumber($this->disc_rp->ViewValue, 2, -2, -2, -2);
			$this->disc_rp->ViewCustomAttributes = "";

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

			// stok
			$this->stok->ViewValue = $this->stok->CurrentValue;
			$this->stok->ViewValue = FormatNumber($this->stok->ViewValue, 2, -2, -2, -2);
			$this->stok->ViewCustomAttributes = "";

			// satuan
			$curVal = strval($this->satuan->CurrentValue);
			if ($curVal != "") {
				$this->satuan->ViewValue = $this->satuan->lookupCacheOption($curVal);
				if ($this->satuan->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_satuan`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->satuan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->satuan->ViewValue = $this->satuan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->satuan->ViewValue = $this->satuan->CurrentValue;
					}
				}
			} else {
				$this->satuan->ViewValue = NULL;
			}
			$this->satuan->ViewCustomAttributes = "";

			// minimum_stok
			$this->minimum_stok->ViewValue = $this->minimum_stok->CurrentValue;
			$this->minimum_stok->ViewValue = FormatNumber($this->minimum_stok->ViewValue, 0, -2, -2, -2);
			$this->minimum_stok->ViewCustomAttributes = "";

			// tgl_masuk
			$this->tgl_masuk->ViewValue = $this->tgl_masuk->CurrentValue;
			$this->tgl_masuk->ViewValue = FormatDateTime($this->tgl_masuk->ViewValue, 0);
			$this->tgl_masuk->ViewCustomAttributes = "";

			// tgl_exp
			$this->tgl_exp->ViewValue = $this->tgl_exp->CurrentValue;
			$this->tgl_exp->ViewValue = FormatDateTime($this->tgl_exp->ViewValue, 0);
			$this->tgl_exp->ViewCustomAttributes = "";

			// kategori
			$curVal = strval($this->kategori->CurrentValue);
			if ($curVal != "") {
				$this->kategori->ViewValue = $this->kategori->lookupCacheOption($curVal);
				if ($this->kategori->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
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

			// subkategori
			$curVal = strval($this->subkategori->CurrentValue);
			if ($curVal != "") {
				$this->subkategori->ViewValue = $this->subkategori->lookupCacheOption($curVal);
				if ($this->subkategori->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->subkategori->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->subkategori->ViewValue = $this->subkategori->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->subkategori->ViewValue = $this->subkategori->CurrentValue;
					}
				}
			} else {
				$this->subkategori->ViewValue = NULL;
			}
			$this->subkategori->ViewCustomAttributes = "";

			// id_barang
			$this->id_barang->LinkCustomAttributes = "";
			$this->id_barang->HrefValue = "";
			$this->id_barang->TooltipValue = "";

			// totalhargajual
			$this->totalhargajual->LinkCustomAttributes = "";
			$this->totalhargajual->HrefValue = "";
			$this->totalhargajual->TooltipValue = "";

			// disc_pr
			$this->disc_pr->LinkCustomAttributes = "";
			$this->disc_pr->HrefValue = "";
			$this->disc_pr->TooltipValue = "";

			// disc_rp
			$this->disc_rp->LinkCustomAttributes = "";
			$this->disc_rp->HrefValue = "";
			$this->disc_rp->TooltipValue = "";

			// id_klinik
			$this->id_klinik->LinkCustomAttributes = "";
			$this->id_klinik->HrefValue = "";
			$this->id_klinik->TooltipValue = "";

			// stok
			$this->stok->LinkCustomAttributes = "";
			$this->stok->HrefValue = "";
			$this->stok->TooltipValue = "";

			// satuan
			$this->satuan->LinkCustomAttributes = "";
			$this->satuan->HrefValue = "";
			$this->satuan->TooltipValue = "";

			// minimum_stok
			$this->minimum_stok->LinkCustomAttributes = "";
			$this->minimum_stok->HrefValue = "";
			$this->minimum_stok->TooltipValue = "";

			// tgl_masuk
			$this->tgl_masuk->LinkCustomAttributes = "";
			$this->tgl_masuk->HrefValue = "";
			$this->tgl_masuk->TooltipValue = "";

			// tgl_exp
			$this->tgl_exp->LinkCustomAttributes = "";
			$this->tgl_exp->HrefValue = "";
			$this->tgl_exp->TooltipValue = "";

			// kategori
			$this->kategori->LinkCustomAttributes = "";
			$this->kategori->HrefValue = "";
			$this->kategori->TooltipValue = "";

			// subkategori
			$this->subkategori->LinkCustomAttributes = "";
			$this->subkategori->HrefValue = "";
			$this->subkategori->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// id_barang
			$this->id_barang->EditCustomAttributes = "";
			$curVal = trim(strval($this->id_barang->CurrentValue));
			if ($curVal != "")
				$this->id_barang->ViewValue = $this->id_barang->lookupCacheOption($curVal);
			else
				$this->id_barang->ViewValue = $this->id_barang->Lookup !== NULL && is_array($this->id_barang->Lookup->Options) ? $curVal : NULL;
			if ($this->id_barang->ViewValue !== NULL) { // Load from cache
				$this->id_barang->EditValue = array_values($this->id_barang->Lookup->Options);
				if ($this->id_barang->ViewValue == "")
					$this->id_barang->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->id_barang->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->id_barang->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->id_barang->ViewValue = $this->id_barang->displayValue($arwrk);
				} else {
					$this->id_barang->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->id_barang->EditValue = $arwrk;
			}

			// totalhargajual
			$this->totalhargajual->EditAttrs["class"] = "form-control";
			$this->totalhargajual->EditCustomAttributes = "";
			$this->totalhargajual->EditValue = HtmlEncode($this->totalhargajual->CurrentValue);
			$this->totalhargajual->PlaceHolder = RemoveHtml($this->totalhargajual->caption());
			if (strval($this->totalhargajual->EditValue) != "" && is_numeric($this->totalhargajual->EditValue))
				$this->totalhargajual->EditValue = FormatNumber($this->totalhargajual->EditValue, -2, -2, -2, -2);
			

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

			// stok
			$this->stok->EditAttrs["class"] = "form-control";
			$this->stok->EditCustomAttributes = "Readonly";
			$this->stok->EditValue = HtmlEncode($this->stok->CurrentValue);
			$this->stok->PlaceHolder = RemoveHtml($this->stok->caption());
			if (strval($this->stok->EditValue) != "" && is_numeric($this->stok->EditValue))
				$this->stok->EditValue = FormatNumber($this->stok->EditValue, -2, -2, -2, -2);
			

			// satuan
			$this->satuan->EditAttrs["class"] = "form-control";
			$this->satuan->EditCustomAttributes = "";
			$curVal = trim(strval($this->satuan->CurrentValue));
			if ($curVal != "")
				$this->satuan->ViewValue = $this->satuan->lookupCacheOption($curVal);
			else
				$this->satuan->ViewValue = $this->satuan->Lookup !== NULL && is_array($this->satuan->Lookup->Options) ? $curVal : NULL;
			if ($this->satuan->ViewValue !== NULL) { // Load from cache
				$this->satuan->EditValue = array_values($this->satuan->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_satuan`" . SearchString("=", $this->satuan->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->satuan->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->satuan->EditValue = $arwrk;
			}

			// minimum_stok
			$this->minimum_stok->EditAttrs["class"] = "form-control";
			$this->minimum_stok->EditCustomAttributes = "";
			$this->minimum_stok->EditValue = HtmlEncode($this->minimum_stok->CurrentValue);
			$this->minimum_stok->PlaceHolder = RemoveHtml($this->minimum_stok->caption());

			// tgl_masuk
			$this->tgl_masuk->EditAttrs["class"] = "form-control";
			$this->tgl_masuk->EditCustomAttributes = "";
			$this->tgl_masuk->EditValue = HtmlEncode(FormatDateTime($this->tgl_masuk->CurrentValue, 8));
			$this->tgl_masuk->PlaceHolder = RemoveHtml($this->tgl_masuk->caption());

			// tgl_exp
			$this->tgl_exp->EditAttrs["class"] = "form-control";
			$this->tgl_exp->EditCustomAttributes = "";
			$this->tgl_exp->EditValue = HtmlEncode(FormatDateTime($this->tgl_exp->CurrentValue, 8));
			$this->tgl_exp->PlaceHolder = RemoveHtml($this->tgl_exp->caption());

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
					$filterWrk = "`id`" . SearchString("=", $this->kategori->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kategori->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kategori->EditValue = $arwrk;
			}

			// subkategori
			$this->subkategori->EditAttrs["class"] = "form-control";
			$this->subkategori->EditCustomAttributes = "";
			$curVal = trim(strval($this->subkategori->CurrentValue));
			if ($curVal != "")
				$this->subkategori->ViewValue = $this->subkategori->lookupCacheOption($curVal);
			else
				$this->subkategori->ViewValue = $this->subkategori->Lookup !== NULL && is_array($this->subkategori->Lookup->Options) ? $curVal : NULL;
			if ($this->subkategori->ViewValue !== NULL) { // Load from cache
				$this->subkategori->EditValue = array_values($this->subkategori->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->subkategori->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->subkategori->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->subkategori->EditValue = $arwrk;
			}

			// Edit refer script
			// id_barang

			$this->id_barang->LinkCustomAttributes = "";
			$this->id_barang->HrefValue = "";

			// totalhargajual
			$this->totalhargajual->LinkCustomAttributes = "";
			$this->totalhargajual->HrefValue = "";

			// disc_pr
			$this->disc_pr->LinkCustomAttributes = "";
			$this->disc_pr->HrefValue = "";

			// disc_rp
			$this->disc_rp->LinkCustomAttributes = "";
			$this->disc_rp->HrefValue = "";

			// id_klinik
			$this->id_klinik->LinkCustomAttributes = "";
			$this->id_klinik->HrefValue = "";

			// stok
			$this->stok->LinkCustomAttributes = "";
			$this->stok->HrefValue = "";

			// satuan
			$this->satuan->LinkCustomAttributes = "";
			$this->satuan->HrefValue = "";

			// minimum_stok
			$this->minimum_stok->LinkCustomAttributes = "";
			$this->minimum_stok->HrefValue = "";

			// tgl_masuk
			$this->tgl_masuk->LinkCustomAttributes = "";
			$this->tgl_masuk->HrefValue = "";

			// tgl_exp
			$this->tgl_exp->LinkCustomAttributes = "";
			$this->tgl_exp->HrefValue = "";

			// kategori
			$this->kategori->LinkCustomAttributes = "";
			$this->kategori->HrefValue = "";

			// subkategori
			$this->subkategori->LinkCustomAttributes = "";
			$this->subkategori->HrefValue = "";
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
		if ($this->id_barang->Required) {
			if (!$this->id_barang->IsDetailKey && $this->id_barang->FormValue != NULL && $this->id_barang->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_barang->caption(), $this->id_barang->RequiredErrorMessage));
			}
		}
		if ($this->totalhargajual->Required) {
			if (!$this->totalhargajual->IsDetailKey && $this->totalhargajual->FormValue != NULL && $this->totalhargajual->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->totalhargajual->caption(), $this->totalhargajual->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->totalhargajual->FormValue)) {
			AddMessage($FormError, $this->totalhargajual->errorMessage());
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
		if ($this->id_klinik->Required) {
			if (!$this->id_klinik->IsDetailKey && $this->id_klinik->FormValue != NULL && $this->id_klinik->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_klinik->caption(), $this->id_klinik->RequiredErrorMessage));
			}
		}
		if ($this->stok->Required) {
			if (!$this->stok->IsDetailKey && $this->stok->FormValue != NULL && $this->stok->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->stok->caption(), $this->stok->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->stok->FormValue)) {
			AddMessage($FormError, $this->stok->errorMessage());
		}
		if ($this->satuan->Required) {
			if (!$this->satuan->IsDetailKey && $this->satuan->FormValue != NULL && $this->satuan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->satuan->caption(), $this->satuan->RequiredErrorMessage));
			}
		}
		if ($this->minimum_stok->Required) {
			if (!$this->minimum_stok->IsDetailKey && $this->minimum_stok->FormValue != NULL && $this->minimum_stok->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->minimum_stok->caption(), $this->minimum_stok->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->minimum_stok->FormValue)) {
			AddMessage($FormError, $this->minimum_stok->errorMessage());
		}
		if ($this->tgl_masuk->Required) {
			if (!$this->tgl_masuk->IsDetailKey && $this->tgl_masuk->FormValue != NULL && $this->tgl_masuk->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgl_masuk->caption(), $this->tgl_masuk->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tgl_masuk->FormValue)) {
			AddMessage($FormError, $this->tgl_masuk->errorMessage());
		}
		if ($this->tgl_exp->Required) {
			if (!$this->tgl_exp->IsDetailKey && $this->tgl_exp->FormValue != NULL && $this->tgl_exp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgl_exp->caption(), $this->tgl_exp->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tgl_exp->FormValue)) {
			AddMessage($FormError, $this->tgl_exp->errorMessage());
		}
		if ($this->kategori->Required) {
			if (!$this->kategori->IsDetailKey && $this->kategori->FormValue != NULL && $this->kategori->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kategori->caption(), $this->kategori->RequiredErrorMessage));
			}
		}
		if ($this->subkategori->Required) {
			if (!$this->subkategori->IsDetailKey && $this->subkategori->FormValue != NULL && $this->subkategori->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->subkategori->caption(), $this->subkategori->RequiredErrorMessage));
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

			// totalhargajual
			$this->totalhargajual->setDbValueDef($rsnew, $this->totalhargajual->CurrentValue, NULL, $this->totalhargajual->ReadOnly);

			// disc_pr
			$this->disc_pr->setDbValueDef($rsnew, $this->disc_pr->CurrentValue, NULL, $this->disc_pr->ReadOnly);

			// disc_rp
			$this->disc_rp->setDbValueDef($rsnew, $this->disc_rp->CurrentValue, NULL, $this->disc_rp->ReadOnly);

			// id_klinik
			$this->id_klinik->setDbValueDef($rsnew, $this->id_klinik->CurrentValue, NULL, $this->id_klinik->ReadOnly);

			// stok
			$this->stok->setDbValueDef($rsnew, $this->stok->CurrentValue, NULL, $this->stok->ReadOnly);

			// satuan
			$this->satuan->setDbValueDef($rsnew, $this->satuan->CurrentValue, NULL, $this->satuan->ReadOnly);

			// minimum_stok
			$this->minimum_stok->setDbValueDef($rsnew, $this->minimum_stok->CurrentValue, NULL, $this->minimum_stok->ReadOnly);

			// tgl_masuk
			$this->tgl_masuk->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_masuk->CurrentValue, 0), NULL, $this->tgl_masuk->ReadOnly);

			// tgl_exp
			$this->tgl_exp->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_exp->CurrentValue, 0), NULL, $this->tgl_exp->ReadOnly);

			// kategori
			$this->kategori->setDbValueDef($rsnew, $this->kategori->CurrentValue, NULL, $this->kategori->ReadOnly);

			// subkategori
			$this->subkategori->setDbValueDef($rsnew, $this->subkategori->CurrentValue, NULL, $this->subkategori->ReadOnly);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("m_hargajuallist.php"), "", $this->TableVar, TRUE);
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
				case "x_id_klinik":
					break;
				case "x_satuan":
					break;
				case "x_kategori":
					break;
				case "x_subkategori":
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
						case "x_id_klinik":
							break;
						case "x_satuan":
							break;
						case "x_kategori":
							break;
						case "x_subkategori":
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