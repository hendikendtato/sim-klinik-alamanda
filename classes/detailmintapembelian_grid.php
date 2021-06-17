<?php
namespace PHPMaker2020\sim_klinik_alamanda;

/**
 * Page class
 */
class detailmintapembelian_grid extends detailmintapembelian
{

	// Page ID
	public $PageID = "grid";

	// Project ID
	public $ProjectID = "{8546B030-7993-4749-BFDB-17AFAAF4065D}";

	// Table name
	public $TableName = 'detailmintapembelian';

	// Page object name
	public $PageObjName = "detailmintapembelian_grid";

	// Grid form hidden field names
	public $FormName = "fdetailmintapembeliangrid";
	public $FormActionName = "k_action";
	public $FormKeyName = "k_key";
	public $FormOldKeyName = "k_oldkey";
	public $FormBlankRowName = "k_blankrow";
	public $FormKeyCountName = "key_count";

	// Page URLs
	public $AddUrl;
	public $EditUrl;
	public $CopyUrl;
	public $DeleteUrl;
	public $ViewUrl;
	public $ListUrl;

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
		$this->FormActionName .= "_" . $this->FormName;
		$this->FormKeyName .= "_" . $this->FormName;
		$this->FormOldKeyName .= "_" . $this->FormName;
		$this->FormBlankRowName .= "_" . $this->FormName;
		$this->FormKeyCountName .= "_" . $this->FormName;
		$GLOBALS["Grid"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (detailmintapembelian)
		if (!isset($GLOBALS["detailmintapembelian"]) || get_class($GLOBALS["detailmintapembelian"]) == PROJECT_NAMESPACE . "detailmintapembelian") {
			$GLOBALS["detailmintapembelian"] = &$this;

			// $GLOBALS["MasterTable"] = &$GLOBALS["Table"];
			// if (!isset($GLOBALS["Table"]))
			// 	$GLOBALS["Table"] = &$GLOBALS["detailmintapembelian"];

		}
		$this->AddUrl = "detailmintapembelianadd.php";

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'grid');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'detailmintapembelian');

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

		// List options
		$this->ListOptions = new ListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["addedit"] = new ListOptions("div");
		$this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Export
		global $detailmintapembelian;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($detailmintapembelian);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}

//		$GLOBALS["Table"] = &$GLOBALS["MasterTable"];
		unset($GLOBALS["Grid"]);
		if ($url === "")
			return;
		if (!IsApi())
			$this->Page_Redirecting($url);

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
			SaveDebugMessage();
			AddHeader("Location", $url);
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
			$key .= @$ar['id_detailpp'];
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
			$this->id_detailpp->Visible = FALSE;
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

	// Class variables
	public $ListOptions; // List options
	public $ExportOptions; // Export options
	public $SearchOptions; // Search options
	public $OtherOptions; // Other options
	public $FilterOptions; // Filter options
	public $ImportOptions; // Import options
	public $ListActions; // List actions
	public $SelectedCount = 0;
	public $SelectedIndex = 0;
	public $ShowOtherOptions = FALSE;
	public $DisplayRecords = 20;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $PageSizes = "10,20,50,-1"; // Page sizes (comma separated)
	public $DefaultSearchWhere = ""; // Default search WHERE clause
	public $SearchWhere = ""; // Search WHERE clause
	public $SearchPanelClass = "ew-search-panel collapse show"; // Search Panel class
	public $SearchRowCount = 0; // For extended search
	public $SearchColumnCount = 0; // For extended search
	public $SearchFieldsPerRow = 1; // For extended search
	public $RecordCount = 0; // Record count
	public $EditRowCount;
	public $StartRowCount = 1;
	public $RowCount = 0;
	public $Attrs = []; // Row attributes and cell attributes
	public $RowIndex = 0; // Row index
	public $KeyCount = 0; // Key count
	public $RowAction = ""; // Row action
	public $RowOldKey = ""; // Row old key (for copy)
	public $MultiColumnClass = "col-sm";
	public $MultiColumnEditClass = "w-100";
	public $DbMasterFilter = ""; // Master filter
	public $DbDetailFilter = ""; // Detail filter
	public $MasterRecordExists;
	public $MultiSelectKey;
	public $Command;
	public $RestoreSearch = FALSE;
	public $DetailPages;
	public $OldRecordset;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SearchError;

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
		} else {
			$Security = new AdvancedSecurity();
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canList()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				$this->terminate(GetUrl("index.php"));
				return;
			}
		}

		// Get grid add count
		$gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->setupListOptions();
		$this->id_detailpp->setVisibility();
		$this->pid_pp->setVisibility();
		$this->idbarang->setVisibility();
		$this->part->setVisibility();
		$this->lot->setVisibility();
		$this->qty_pp->setVisibility();
		$this->qty_acc->setVisibility();
		$this->id_satuan->setVisibility();
		$this->harga->setVisibility();
		$this->total->setVisibility();
		$this->hideFieldsForAddEdit();

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

		// Set up master detail parameters
		$this->setupMasterParms();

		// Setup other options
		$this->setupOtherOptions();

		// Set up lookup cache
		$this->setupLookupOptions($this->idbarang);
		$this->setupLookupOptions($this->id_satuan);

		// Search filters
		$srchAdvanced = ""; // Advanced search filter
		$srchBasic = ""; // Basic search filter
		$filter = "";

		// Get command
		$this->Command = strtolower(Get("cmd"));
		if ($this->isPageRequest()) { // Validate request

			// Set up records per page
			$this->setupDisplayRecords();

			// Handle reset command
			$this->resetCmd();

			// Hide list options
			if ($this->isExport()) {
				$this->ListOptions->hideAllOptions(["sequence"]);
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->isGridAdd() || $this->isGridEdit()) {
				$this->ListOptions->hideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Show grid delete link for grid add / grid edit
			if ($this->AllowAddDeleteRow) {
				if ($this->isGridAdd() || $this->isGridEdit()) {
					$item = $this->ListOptions["griddelete"];
					if ($item)
						$item->Visible = TRUE;
				}
			}

			// Set up sorting order
			$this->setupSortOrder();
		}

		// Restore display records
		if ($this->Command != "json" && $this->getRecordsPerPage() != "") {
			$this->DisplayRecords = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecords = 20; // Load default
			$this->setRecordsPerPage($this->DisplayRecords); // Save default to Session
		}

		// Load Sorting Order
		if ($this->Command != "json")
			$this->loadSortOrder();

		// Build filter
		$filter = "";
		if (!$Security->canList())
			$filter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->DbMasterFilter = $this->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Restore detail filter
		AddFilter($filter, $this->DbDetailFilter);
		AddFilter($filter, $this->SearchWhere);

		// Load master record
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "permintaanpembelian") {
			global $permintaanpembelian;
			$rsmaster = $permintaanpembelian->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("permintaanpembelianlist.php"); // Return to master page
			} else {
				$permintaanpembelian->loadListRowValues($rsmaster);
				$permintaanpembelian->RowType = ROWTYPE_MASTER; // Master row
				$permintaanpembelian->renderListRow();
				$rsmaster->close();
			}
		}

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSql = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $filter;
		} else {
			$this->setSessionWhere($filter);
			$this->CurrentFilter = "";
		}
		if ($this->isGridAdd()) {
			if ($this->CurrentMode == "copy") {
				$selectLimit = $this->UseSelectLimit;
				if ($selectLimit) {
					$this->TotalRecords = $this->listRecordCount();
					$this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);
				} else {
					if ($this->Recordset = $this->loadRecordset())
						$this->TotalRecords = $this->Recordset->RecordCount();
				}
				$this->StartRecord = 1;
				$this->DisplayRecords = $this->TotalRecords;
			} else {
				$this->CurrentFilter = "0=1";
				$this->StartRecord = 1;
				$this->DisplayRecords = $this->GridAddRowCount;
			}
			$this->TotalRecords = $this->DisplayRecords;
			$this->StopRecord = $this->DisplayRecords;
		} else {
			$selectLimit = $this->UseSelectLimit;
			if ($selectLimit) {
				$this->TotalRecords = $this->listRecordCount();
			} else {
				if ($this->Recordset = $this->loadRecordset())
					$this->TotalRecords = $this->Recordset->RecordCount();
			}
			$this->StartRecord = 1;
			$this->DisplayRecords = $this->TotalRecords; // Display all records
			if ($selectLimit)
				$this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);
		}

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset);
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows, "totalRecordCount" => $this->TotalRecords]);
			$this->terminate(TRUE);
		}

		// Set up pager
		$this->Pager = new PrevNextPager($this->StartRecord, $this->getRecordsPerPage(), $this->TotalRecords, $this->PageSizes, $this->RecordRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);
	}

	// Set up number of records displayed per page
	protected function setupDisplayRecords()
	{
		$wrk = Get(Config("TABLE_REC_PER_PAGE"), "");
		if ($wrk != "") {
			if (is_numeric($wrk)) {
				$this->DisplayRecords = (int)$wrk;
			} else {
				if (SameText($wrk, "all")) { // Display all records
					$this->DisplayRecords = -1;
				} else {
					$this->DisplayRecords = 20; // Non-numeric, load default
				}
			}
			$this->setRecordsPerPage($this->DisplayRecords); // Save to Session

			// Reset start position
			$this->StartRecord = 1;
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Exit inline mode
	protected function clearInlineMode()
	{
		$this->harga->FormValue = ""; // Clear form value
		$this->total->FormValue = ""; // Clear form value
		$this->LastAction = $this->CurrentAction; // Save last action
		$this->CurrentAction = ""; // Clear action
		$_SESSION[SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Add mode
	protected function gridAddMode()
	{
		$this->CurrentAction = "gridadd";
		$_SESSION[SESSION_INLINE_MODE] = "gridadd";
		$this->hideFieldsForAddEdit();
	}

	// Switch to Grid Edit mode
	protected function gridEditMode()
	{
		$this->CurrentAction = "gridedit";
		$_SESSION[SESSION_INLINE_MODE] = "gridedit";
		$this->hideFieldsForAddEdit();
	}

	// Perform update to grid
	public function gridUpdate()
	{
		global $Language, $CurrentForm, $FormError;
		$gridUpdate = TRUE;

		// Get old recordset
		$this->CurrentFilter = $this->buildKeyFilter();
		if ($this->CurrentFilter == "")
			$this->CurrentFilter = "0=1";
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		if ($rs = $conn->execute($sql)) {
			$rsold = $rs->getRows();
			$rs->close();
		}

		// Call Grid Updating event
		if (!$this->Grid_Updating($rsold)) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("GridEditCancelled")); // Set grid edit cancelled message
			return FALSE;
		}
		$key = "";

		// Update row index and get row key
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Update all rows based on key
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
			$CurrentForm->Index = $rowindex;
			$rowkey = strval($CurrentForm->getValue($this->FormKeyName));
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));

			// Load all values and keys
			if ($rowaction != "insertdelete") { // Skip insert then deleted rows
				$this->loadFormValues(); // Get form values
				if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
					$gridUpdate = $this->setupKeyValues($rowkey); // Set up key values
				} else {
					$gridUpdate = TRUE;
				}

				// Skip empty row
				if ($rowaction == "insert" && $this->emptyRow()) {

					// No action required
				// Validate form and insert/update/delete record

				} elseif ($gridUpdate) {
					if ($rowaction == "delete") {
						$this->CurrentFilter = $this->getRecordFilter();
						$gridUpdate = $this->deleteRows(); // Delete this row
					} else if (!$this->validateForm()) {
						$gridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($FormError);
					} else {
						if ($rowaction == "insert") {
							$gridUpdate = $this->addRow(); // Insert this row
						} else {
							if ($rowkey != "") {
								$this->SendEmail = FALSE; // Do not send email on update success
								$gridUpdate = $this->editRow(); // Update this row
							}
						} // End update
					}
				}
				if ($gridUpdate) {
					if ($key != "")
						$key .= ", ";
					$key .= $rowkey;
				} else {
					break;
				}
			}
		}
		if ($gridUpdate) {

			// Get new recordset
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Updated event
			$this->Grid_Updated($rsold, $rsnew);
			$this->clearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("UpdateFailed")); // Set update failed message
		}
		return $gridUpdate;
	}

	// Build filter for all keys
	protected function buildKeyFilter()
	{
		global $CurrentForm;
		$wrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$CurrentForm->Index = $rowindex;
		$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		while ($thisKey != "") {
			if ($this->setupKeyValues($thisKey)) {
				$filter = $this->getRecordFilter();
				if ($wrkFilter != "")
					$wrkFilter .= " OR ";
				$wrkFilter .= $filter;
			} else {
				$wrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$CurrentForm->Index = $rowindex;
			$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		}
		return $wrkFilter;
	}

	// Set up key values
	protected function setupKeyValues($key)
	{
		$arKeyFlds = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($arKeyFlds) >= 1) {
			$this->id_detailpp->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->id_detailpp->OldValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	public function gridInsert()
	{
		global $Language, $CurrentForm, $FormError;
		$rowindex = 1;
		$gridInsert = FALSE;
		$conn = $this->getConnection();

		// Call Grid Inserting event
		if (!$this->Grid_Inserting()) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("GridAddCancelled")); // Set grid add cancelled message
			return FALSE;
		}

		// Init key filter
		$wrkfilter = "";
		$addcnt = 0;
		$key = "";

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction != "" && $rowaction != "insert")
				continue; // Skip
			if ($rowaction == "insert") {
				$this->RowOldKey = strval($CurrentForm->getValue($this->FormOldKeyName));
				$this->loadOldRecord(); // Load old record
			}
			$this->loadFormValues(); // Get form values
			if (!$this->emptyRow()) {
				$addcnt++;
				$this->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->validateForm()) {
					$gridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($FormError);
				} else {
					$gridInsert = $this->addRow($this->OldRecordset); // Insert this row
				}
				if ($gridInsert) {
					if ($key != "")
						$key .= Config("COMPOSITE_KEY_SEPARATOR");
					$key .= $this->id_detailpp->CurrentValue;

					// Add filter for this record
					$filter = $this->getRecordFilter();
					if ($wrkfilter != "")
						$wrkfilter .= " OR ";
					$wrkfilter .= $filter;
				} else {
					break;
				}
			}
		}
		if ($addcnt == 0) { // No record inserted
			$this->clearInlineMode(); // Clear grid add mode and return
			return TRUE;
		}
		if ($gridInsert) {

			// Get new recordset
			$this->CurrentFilter = $wrkfilter;
			$sql = $this->getCurrentSql();
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Inserted event
			$this->Grid_Inserted($rsnew);
			$this->clearInlineMode(); // Clear grid add mode
		} else {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("InsertFailed")); // Set insert failed message
		}
		return $gridInsert;
	}

	// Check if empty row
	public function emptyRow()
	{
		global $CurrentForm;
		if ($CurrentForm->hasValue("x_pid_pp") && $CurrentForm->hasValue("o_pid_pp") && $this->pid_pp->CurrentValue != $this->pid_pp->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_idbarang") && $CurrentForm->hasValue("o_idbarang") && $this->idbarang->CurrentValue != $this->idbarang->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_part") && $CurrentForm->hasValue("o_part") && $this->part->CurrentValue != $this->part->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_lot") && $CurrentForm->hasValue("o_lot") && $this->lot->CurrentValue != $this->lot->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_qty_pp") && $CurrentForm->hasValue("o_qty_pp") && $this->qty_pp->CurrentValue != $this->qty_pp->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_qty_acc") && $CurrentForm->hasValue("o_qty_acc") && $this->qty_acc->CurrentValue != $this->qty_acc->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_id_satuan") && $CurrentForm->hasValue("o_id_satuan") && $this->id_satuan->CurrentValue != $this->id_satuan->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_harga") && $CurrentForm->hasValue("o_harga") && $this->harga->CurrentValue != $this->harga->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_total") && $CurrentForm->hasValue("o_total") && $this->total->CurrentValue != $this->total->OldValue)
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	public function validateGridForm()
	{
		global $CurrentForm;

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction != "delete" && $rowaction != "insertdelete") {
				$this->loadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->emptyRow()) {

					// Ignore
				} else if (!$this->validateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Get all form values of the grid
	public function getGridFormValues()
	{
		global $CurrentForm;

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;
		$rows = [];

		// Loop through all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction != "delete" && $rowaction != "insertdelete") {
				$this->loadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->emptyRow()) {

					// Ignore
				} else {
					$rows[] = $this->getFieldValues("FormValue"); // Return row as array
				}
			}
		}
		return $rows; // Return as array of array
	}

	// Restore form values for current row
	public function restoreCurrentRowFormValues($idx)
	{
		global $CurrentForm;

		// Get row based on current index
		$CurrentForm->Index = $idx;
		$this->loadFormValues(); // Load form values
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	protected function loadSortOrder()
	{
		$orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($orderBy == "") {
			if ($this->getSqlOrderBy() != "") {
				$orderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($orderBy);
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)

	protected function resetCmd()
	{

		// Check if reset command
		if (StartsString("reset", $this->Command)) {

			// Reset master/detail keys
			if ($this->Command == "resetall") {
				$this->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$this->pid_pp->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
			}

			// Reset start position
			$this->StartRecord = 1;
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Set up list options
	protected function setupListOptions()
	{
		global $Security, $Language;

		// "griddelete"
		if ($this->AllowAddDeleteRow) {
			$item = &$this->ListOptions->add("griddelete");
			$item->CssClass = "text-nowrap";
			$item->OnLeft = FALSE;
			$item->Visible = FALSE; // Default hidden
		}

		// Add group option item
		$item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = FALSE;
		$item->Visible = FALSE;

		// "view"
		$item = &$this->ListOptions->add("view");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canView();
		$item->OnLeft = FALSE;

		// "edit"
		$item = &$this->ListOptions->add("edit");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canEdit();
		$item->OnLeft = FALSE;

		// "copy"
		$item = &$this->ListOptions->add("copy");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canAdd();
		$item->OnLeft = FALSE;

		// "delete"
		$item = &$this->ListOptions->add("delete");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canDelete();
		$item->OnLeft = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;

		//$this->ListOptions->ButtonClass = ""; // Class for button group
		// Call ListOptions_Load event

		$this->ListOptions_Load();
		$item = $this->ListOptions[$this->ListOptions->GroupOptionName];
		$item->Visible = $this->ListOptions->groupOptionVisible();
	}

	// Render list options
	public function renderListOptions()
	{
		global $Security, $Language, $CurrentForm;
		$this->ListOptions->loadDefault();

		// Call ListOptions_Rendering event
		$this->ListOptions_Rendering();

		// Set up row action and key
		if (is_numeric($this->RowIndex) && $this->CurrentMode != "view") {
			$CurrentForm->Index = $this->RowIndex;
			$actionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
			$oldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormOldKeyName);
			$keyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormKeyName);
			$blankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
			if ($this->RowAction != "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $actionName . "\" id=\"" . $actionName . "\" value=\"" . $this->RowAction . "\">";
			if ($CurrentForm->hasValue($this->FormOldKeyName))
				$this->RowOldKey = strval($CurrentForm->getValue($this->FormOldKeyName));
			if ($this->RowOldKey != "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $oldKeyName . "\" id=\"" . $oldKeyName . "\" value=\"" . HtmlEncode($this->RowOldKey) . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $CurrentForm->getValue($this->FormKeyName);
				$this->setupKeyValues($rowkey);

				// Reload hidden key for delete
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . HtmlEncode($rowkey) . "\">";
			}
			if ($this->RowAction == "insert" && $this->isConfirm() && $this->emptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $blankRowName . "\" id=\"" . $blankRowName . "\" value=\"1\">";
		}

		// "delete"
		if ($this->AllowAddDeleteRow) {
			if ($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") {
				$options = &$this->ListOptions;
				$options->UseButtonGroup = TRUE; // Use button group for grid delete button
				$opt = $options["griddelete"];
				if (!$Security->canDelete() && is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$opt->Body = "&nbsp;";
				} else {
					$opt->Body = "<a class=\"ew-grid-link ew-grid-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" onclick=\"return ew.deleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->phrase("DeleteLink") . "</a>";
				}
			}
		}
		if ($this->CurrentMode == "view") { // View mode

		// "view"
		$opt = $this->ListOptions["view"];
		$viewcaption = HtmlTitle($Language->phrase("ViewLink"));
		if ($Security->canView()) {
			$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode($this->ViewUrl) . "\">" . $Language->phrase("ViewLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "edit"
		$opt = $this->ListOptions["edit"];
		$editcaption = HtmlTitle($Language->phrase("EditLink"));
		if ($Security->canEdit()) {
			$opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->phrase("EditLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "copy"
		$opt = $this->ListOptions["copy"];
		$copycaption = HtmlTitle($Language->phrase("CopyLink"));
		if ($Security->canAdd()) {
			$opt->Body = "<a class=\"ew-row-link ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode($this->CopyUrl) . "\">" . $Language->phrase("CopyLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "delete"
		$opt = $this->ListOptions["delete"];
		if ($Security->canDelete())
			$opt->Body = "<a class=\"ew-row-link ew-delete\"" . "" . " title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" href=\"" . HtmlEncode($this->DeleteUrl) . "\">" . $Language->phrase("DeleteLink") . "</a>";
		else
			$opt->Body = "";
		} // End View mode
		if ($this->CurrentMode == "edit" && is_numeric($this->RowIndex) && $this->RowAction != "delete") {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->id_detailpp->CurrentValue . "\">";
		}
		$this->renderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set record key
	public function setRecordKey(&$key, $rs)
	{
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs->fields('id_detailpp');
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$option = $this->OtherOptions["addedit"];
		$option->UseDropDownButton = FALSE;
		$option->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
		$option->UseButtonGroup = TRUE;

		//$option->ButtonClass = ""; // Class for button group
		$item = &$option->add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Add
		if ($this->CurrentMode == "view") { // Check view mode
			$item = &$option->add("add");
			$addcaption = HtmlTitle($Language->phrase("AddLink"));
			$this->AddUrl = $this->getAddUrl();
			$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("AddLink") . "</a>";
			$item->Visible = $this->AddUrl != "" && $Security->canAdd();
		}
	}

	// Render other options
	public function renderOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		if (($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") && !$this->isConfirm()) { // Check add/copy/edit mode
			if ($this->AllowAddDeleteRow) {
				$option = $options["addedit"];
				$option->UseDropDownButton = FALSE;
				$item = &$option->add("addblankrow");
				$item->Body = "<a class=\"ew-add-edit ew-add-blank-row\" title=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" href=\"#\" onclick=\"return ew.addGridRow(this);\">" . $Language->phrase("AddBlankRow") . "</a>";
				$item->Visible = $Security->canAdd();
				$this->ShowOtherOptions = $item->Visible;
			}
		}
		if ($this->CurrentMode == "view") { // Check view mode
			$option = $options["addedit"];
			$item = $option["add"];
			$this->ShowOtherOptions = $item && $item->Visible;
		}
	}

// Set up list options (extended codes)
	protected function setupListOptionsExt()
	{

		// Hide detail items for dropdown if necessary
		$this->ListOptions->hideDetailItemsForDropDown();
	}

// Render list options (extended codes)
	protected function renderListOptionsExt()
	{
		global $Security, $Language;
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->id_detailpp->CurrentValue = NULL;
		$this->id_detailpp->OldValue = $this->id_detailpp->CurrentValue;
		$this->pid_pp->CurrentValue = NULL;
		$this->pid_pp->OldValue = $this->pid_pp->CurrentValue;
		$this->idbarang->CurrentValue = NULL;
		$this->idbarang->OldValue = $this->idbarang->CurrentValue;
		$this->part->CurrentValue = NULL;
		$this->part->OldValue = $this->part->CurrentValue;
		$this->lot->CurrentValue = NULL;
		$this->lot->OldValue = $this->lot->CurrentValue;
		$this->qty_pp->CurrentValue = NULL;
		$this->qty_pp->OldValue = $this->qty_pp->CurrentValue;
		$this->qty_acc->CurrentValue = NULL;
		$this->qty_acc->OldValue = $this->qty_acc->CurrentValue;
		$this->id_satuan->CurrentValue = NULL;
		$this->id_satuan->OldValue = $this->id_satuan->CurrentValue;
		$this->harga->CurrentValue = NULL;
		$this->harga->OldValue = $this->harga->CurrentValue;
		$this->total->CurrentValue = NULL;
		$this->total->OldValue = $this->total->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$CurrentForm->FormName = $this->FormName;

		// Check field name 'id_detailpp' first before field var 'x_id_detailpp'
		$val = $CurrentForm->hasValue("id_detailpp") ? $CurrentForm->getValue("id_detailpp") : $CurrentForm->getValue("x_id_detailpp");
		if (!$this->id_detailpp->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->id_detailpp->setFormValue($val);

		// Check field name 'pid_pp' first before field var 'x_pid_pp'
		$val = $CurrentForm->hasValue("pid_pp") ? $CurrentForm->getValue("pid_pp") : $CurrentForm->getValue("x_pid_pp");
		if (!$this->pid_pp->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->pid_pp->Visible = FALSE; // Disable update for API request
			else
				$this->pid_pp->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_pid_pp"))
			$this->pid_pp->setOldValue($CurrentForm->getValue("o_pid_pp"));

		// Check field name 'idbarang' first before field var 'x_idbarang'
		$val = $CurrentForm->hasValue("idbarang") ? $CurrentForm->getValue("idbarang") : $CurrentForm->getValue("x_idbarang");
		if (!$this->idbarang->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->idbarang->Visible = FALSE; // Disable update for API request
			else
				$this->idbarang->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_idbarang"))
			$this->idbarang->setOldValue($CurrentForm->getValue("o_idbarang"));

		// Check field name 'part' first before field var 'x_part'
		$val = $CurrentForm->hasValue("part") ? $CurrentForm->getValue("part") : $CurrentForm->getValue("x_part");
		if (!$this->part->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->part->Visible = FALSE; // Disable update for API request
			else
				$this->part->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_part"))
			$this->part->setOldValue($CurrentForm->getValue("o_part"));

		// Check field name 'lot' first before field var 'x_lot'
		$val = $CurrentForm->hasValue("lot") ? $CurrentForm->getValue("lot") : $CurrentForm->getValue("x_lot");
		if (!$this->lot->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->lot->Visible = FALSE; // Disable update for API request
			else
				$this->lot->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_lot"))
			$this->lot->setOldValue($CurrentForm->getValue("o_lot"));

		// Check field name 'qty_pp' first before field var 'x_qty_pp'
		$val = $CurrentForm->hasValue("qty_pp") ? $CurrentForm->getValue("qty_pp") : $CurrentForm->getValue("x_qty_pp");
		if (!$this->qty_pp->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->qty_pp->Visible = FALSE; // Disable update for API request
			else
				$this->qty_pp->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_qty_pp"))
			$this->qty_pp->setOldValue($CurrentForm->getValue("o_qty_pp"));

		// Check field name 'qty_acc' first before field var 'x_qty_acc'
		$val = $CurrentForm->hasValue("qty_acc") ? $CurrentForm->getValue("qty_acc") : $CurrentForm->getValue("x_qty_acc");
		if (!$this->qty_acc->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->qty_acc->Visible = FALSE; // Disable update for API request
			else
				$this->qty_acc->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_qty_acc"))
			$this->qty_acc->setOldValue($CurrentForm->getValue("o_qty_acc"));

		// Check field name 'id_satuan' first before field var 'x_id_satuan'
		$val = $CurrentForm->hasValue("id_satuan") ? $CurrentForm->getValue("id_satuan") : $CurrentForm->getValue("x_id_satuan");
		if (!$this->id_satuan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->id_satuan->Visible = FALSE; // Disable update for API request
			else
				$this->id_satuan->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_id_satuan"))
			$this->id_satuan->setOldValue($CurrentForm->getValue("o_id_satuan"));

		// Check field name 'harga' first before field var 'x_harga'
		$val = $CurrentForm->hasValue("harga") ? $CurrentForm->getValue("harga") : $CurrentForm->getValue("x_harga");
		if (!$this->harga->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->harga->Visible = FALSE; // Disable update for API request
			else
				$this->harga->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_harga"))
			$this->harga->setOldValue($CurrentForm->getValue("o_harga"));

		// Check field name 'total' first before field var 'x_total'
		$val = $CurrentForm->hasValue("total") ? $CurrentForm->getValue("total") : $CurrentForm->getValue("x_total");
		if (!$this->total->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->total->Visible = FALSE; // Disable update for API request
			else
				$this->total->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_total"))
			$this->total->setOldValue($CurrentForm->getValue("o_total"));
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->id_detailpp->CurrentValue = $this->id_detailpp->FormValue;
		$this->pid_pp->CurrentValue = $this->pid_pp->FormValue;
		$this->idbarang->CurrentValue = $this->idbarang->FormValue;
		$this->part->CurrentValue = $this->part->FormValue;
		$this->lot->CurrentValue = $this->lot->FormValue;
		$this->qty_pp->CurrentValue = $this->qty_pp->FormValue;
		$this->qty_acc->CurrentValue = $this->qty_acc->FormValue;
		$this->id_satuan->CurrentValue = $this->id_satuan->FormValue;
		$this->harga->CurrentValue = $this->harga->FormValue;
		$this->total->CurrentValue = $this->total->FormValue;
	}

	// Load recordset
	public function loadRecordset($offset = -1, $rowcnt = -1)
	{

		// Load List page SQL
		$sql = $this->getListSql();
		$conn = $this->getConnection();

		// Load recordset
		$dbtype = GetConnectionType($this->Dbid);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			if ($dbtype == "MSSQL") {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())]);
			} else {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = "";
		} else {
			$rs = LoadRecordset($sql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
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
		$this->id_detailpp->setDbValue($row['id_detailpp']);
		$this->pid_pp->setDbValue($row['pid_pp']);
		$this->idbarang->setDbValue($row['idbarang']);
		$this->part->setDbValue($row['part']);
		$this->lot->setDbValue($row['lot']);
		$this->qty_pp->setDbValue($row['qty_pp']);
		$this->qty_acc->setDbValue($row['qty_acc']);
		$this->id_satuan->setDbValue($row['id_satuan']);
		$this->harga->setDbValue($row['harga']);
		$this->total->setDbValue($row['total']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id_detailpp'] = $this->id_detailpp->CurrentValue;
		$row['pid_pp'] = $this->pid_pp->CurrentValue;
		$row['idbarang'] = $this->idbarang->CurrentValue;
		$row['part'] = $this->part->CurrentValue;
		$row['lot'] = $this->lot->CurrentValue;
		$row['qty_pp'] = $this->qty_pp->CurrentValue;
		$row['qty_acc'] = $this->qty_acc->CurrentValue;
		$row['id_satuan'] = $this->id_satuan->CurrentValue;
		$row['harga'] = $this->harga->CurrentValue;
		$row['total'] = $this->total->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		$keys = [$this->RowOldKey];
		$cnt = count($keys);
		if ($cnt >= 1) {
			if (strval($keys[0]) != "")
				$this->id_detailpp->OldValue = strval($keys[0]); // id_detailpp
			else
				$validKey = FALSE;
		} else {
			$validKey = FALSE;
		}

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
		$this->ViewUrl = $this->getViewUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();

		// Convert decimal values if posted back
		if ($this->harga->FormValue == $this->harga->CurrentValue && is_numeric(ConvertToFloatString($this->harga->CurrentValue)))
			$this->harga->CurrentValue = ConvertToFloatString($this->harga->CurrentValue);

		// Convert decimal values if posted back
		if ($this->total->FormValue == $this->total->CurrentValue && is_numeric(ConvertToFloatString($this->total->CurrentValue)))
			$this->total->CurrentValue = ConvertToFloatString($this->total->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id_detailpp
		// pid_pp
		// idbarang
		// part
		// lot
		// qty_pp
		// qty_acc
		// id_satuan
		// harga
		// total

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id_detailpp
			$this->id_detailpp->ViewValue = $this->id_detailpp->CurrentValue;
			$this->id_detailpp->ViewCustomAttributes = "";

			// pid_pp
			$this->pid_pp->ViewValue = $this->pid_pp->CurrentValue;
			$this->pid_pp->ViewValue = FormatNumber($this->pid_pp->ViewValue, 0, -2, -2, -2);
			$this->pid_pp->ViewCustomAttributes = "";

			// idbarang
			$curVal = strval($this->idbarang->CurrentValue);
			if ($curVal != "") {
				$this->idbarang->ViewValue = $this->idbarang->lookupCacheOption($curVal);
				if ($this->idbarang->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->idbarang->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->idbarang->ViewValue = $this->idbarang->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->idbarang->ViewValue = $this->idbarang->CurrentValue;
					}
				}
			} else {
				$this->idbarang->ViewValue = NULL;
			}
			$this->idbarang->ViewCustomAttributes = "";

			// part
			$this->part->ViewValue = $this->part->CurrentValue;
			$this->part->ViewCustomAttributes = "";

			// lot
			$this->lot->ViewValue = $this->lot->CurrentValue;
			$this->lot->ViewCustomAttributes = "";

			// qty_pp
			$this->qty_pp->ViewValue = $this->qty_pp->CurrentValue;
			$this->qty_pp->ViewValue = FormatNumber($this->qty_pp->ViewValue, 0, -2, -2, -2);
			$this->qty_pp->ViewCustomAttributes = "";

			// qty_acc
			$this->qty_acc->ViewValue = $this->qty_acc->CurrentValue;
			$this->qty_acc->ViewValue = FormatNumber($this->qty_acc->ViewValue, 0, -2, -2, -2);
			$this->qty_acc->ViewCustomAttributes = "";

			// id_satuan
			$curVal = strval($this->id_satuan->CurrentValue);
			if ($curVal != "") {
				$this->id_satuan->ViewValue = $this->id_satuan->lookupCacheOption($curVal);
				if ($this->id_satuan->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_satuan`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_satuan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_satuan->ViewValue = $this->id_satuan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_satuan->ViewValue = $this->id_satuan->CurrentValue;
					}
				}
			} else {
				$this->id_satuan->ViewValue = NULL;
			}
			$this->id_satuan->ViewCustomAttributes = "";

			// harga
			$this->harga->ViewValue = $this->harga->CurrentValue;
			$this->harga->ViewValue = FormatNumber($this->harga->ViewValue, 2, -2, -2, -2);
			$this->harga->ViewCustomAttributes = "";

			// total
			$this->total->ViewValue = $this->total->CurrentValue;
			$this->total->ViewValue = FormatNumber($this->total->ViewValue, 2, -2, -2, -2);
			$this->total->ViewCustomAttributes = "";

			// id_detailpp
			$this->id_detailpp->LinkCustomAttributes = "";
			$this->id_detailpp->HrefValue = "";
			$this->id_detailpp->TooltipValue = "";

			// pid_pp
			$this->pid_pp->LinkCustomAttributes = "";
			$this->pid_pp->HrefValue = "";
			$this->pid_pp->TooltipValue = "";

			// idbarang
			$this->idbarang->LinkCustomAttributes = "";
			$this->idbarang->HrefValue = "";
			$this->idbarang->TooltipValue = "";

			// part
			$this->part->LinkCustomAttributes = "";
			$this->part->HrefValue = "";
			$this->part->TooltipValue = "";

			// lot
			$this->lot->LinkCustomAttributes = "";
			$this->lot->HrefValue = "";
			$this->lot->TooltipValue = "";

			// qty_pp
			$this->qty_pp->LinkCustomAttributes = "";
			$this->qty_pp->HrefValue = "";
			$this->qty_pp->TooltipValue = "";

			// qty_acc
			$this->qty_acc->LinkCustomAttributes = "";
			$this->qty_acc->HrefValue = "";
			$this->qty_acc->TooltipValue = "";

			// id_satuan
			$this->id_satuan->LinkCustomAttributes = "";
			$this->id_satuan->HrefValue = "";
			$this->id_satuan->TooltipValue = "";

			// harga
			$this->harga->LinkCustomAttributes = "";
			$this->harga->HrefValue = "";
			$this->harga->TooltipValue = "";

			// total
			$this->total->LinkCustomAttributes = "";
			$this->total->HrefValue = "";
			$this->total->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// id_detailpp
			// pid_pp

			$this->pid_pp->EditAttrs["class"] = "form-control";
			$this->pid_pp->EditCustomAttributes = "";
			if ($this->pid_pp->getSessionValue() != "") {
				$this->pid_pp->CurrentValue = $this->pid_pp->getSessionValue();
				$this->pid_pp->OldValue = $this->pid_pp->CurrentValue;
				$this->pid_pp->ViewValue = $this->pid_pp->CurrentValue;
				$this->pid_pp->ViewValue = FormatNumber($this->pid_pp->ViewValue, 0, -2, -2, -2);
				$this->pid_pp->ViewCustomAttributes = "";
			} else {
				$this->pid_pp->EditValue = HtmlEncode($this->pid_pp->CurrentValue);
				$this->pid_pp->PlaceHolder = RemoveHtml($this->pid_pp->caption());
			}

			// idbarang
			$this->idbarang->EditAttrs["class"] = "form-control";
			$this->idbarang->EditCustomAttributes = "";
			$curVal = trim(strval($this->idbarang->CurrentValue));
			if ($curVal != "")
				$this->idbarang->ViewValue = $this->idbarang->lookupCacheOption($curVal);
			else
				$this->idbarang->ViewValue = $this->idbarang->Lookup !== NULL && is_array($this->idbarang->Lookup->Options) ? $curVal : NULL;
			if ($this->idbarang->ViewValue !== NULL) { // Load from cache
				$this->idbarang->EditValue = array_values($this->idbarang->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->idbarang->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->idbarang->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->idbarang->EditValue = $arwrk;
			}

			// part
			$this->part->EditAttrs["class"] = "form-control";
			$this->part->EditCustomAttributes = "";
			if (!$this->part->Raw)
				$this->part->CurrentValue = HtmlDecode($this->part->CurrentValue);
			$this->part->EditValue = HtmlEncode($this->part->CurrentValue);
			$this->part->PlaceHolder = RemoveHtml($this->part->caption());

			// lot
			$this->lot->EditAttrs["class"] = "form-control";
			$this->lot->EditCustomAttributes = "";
			if (!$this->lot->Raw)
				$this->lot->CurrentValue = HtmlDecode($this->lot->CurrentValue);
			$this->lot->EditValue = HtmlEncode($this->lot->CurrentValue);
			$this->lot->PlaceHolder = RemoveHtml($this->lot->caption());

			// qty_pp
			$this->qty_pp->EditAttrs["class"] = "form-control";
			$this->qty_pp->EditCustomAttributes = "";
			$this->qty_pp->EditValue = HtmlEncode($this->qty_pp->CurrentValue);
			$this->qty_pp->PlaceHolder = RemoveHtml($this->qty_pp->caption());

			// qty_acc
			$this->qty_acc->EditAttrs["class"] = "form-control";
			$this->qty_acc->EditCustomAttributes = "";
			$this->qty_acc->EditValue = HtmlEncode($this->qty_acc->CurrentValue);
			$this->qty_acc->PlaceHolder = RemoveHtml($this->qty_acc->caption());

			// id_satuan
			$this->id_satuan->EditAttrs["class"] = "form-control";
			$this->id_satuan->EditCustomAttributes = "";
			$curVal = trim(strval($this->id_satuan->CurrentValue));
			if ($curVal != "")
				$this->id_satuan->ViewValue = $this->id_satuan->lookupCacheOption($curVal);
			else
				$this->id_satuan->ViewValue = $this->id_satuan->Lookup !== NULL && is_array($this->id_satuan->Lookup->Options) ? $curVal : NULL;
			if ($this->id_satuan->ViewValue !== NULL) { // Load from cache
				$this->id_satuan->EditValue = array_values($this->id_satuan->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_satuan`" . SearchString("=", $this->id_satuan->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->id_satuan->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->id_satuan->EditValue = $arwrk;
			}

			// harga
			$this->harga->EditAttrs["class"] = "form-control";
			$this->harga->EditCustomAttributes = "";
			$this->harga->EditValue = HtmlEncode($this->harga->CurrentValue);
			$this->harga->PlaceHolder = RemoveHtml($this->harga->caption());
			if (strval($this->harga->EditValue) != "" && is_numeric($this->harga->EditValue)) {
				$this->harga->EditValue = FormatNumber($this->harga->EditValue, -2, -2, -2, -2);
				$this->harga->OldValue = $this->harga->EditValue;
			}
			

			// total
			$this->total->EditAttrs["class"] = "form-control";
			$this->total->EditCustomAttributes = "";
			$this->total->EditValue = HtmlEncode($this->total->CurrentValue);
			$this->total->PlaceHolder = RemoveHtml($this->total->caption());
			if (strval($this->total->EditValue) != "" && is_numeric($this->total->EditValue)) {
				$this->total->EditValue = FormatNumber($this->total->EditValue, -2, -2, -2, -2);
				$this->total->OldValue = $this->total->EditValue;
			}
			

			// Add refer script
			// id_detailpp

			$this->id_detailpp->LinkCustomAttributes = "";
			$this->id_detailpp->HrefValue = "";

			// pid_pp
			$this->pid_pp->LinkCustomAttributes = "";
			$this->pid_pp->HrefValue = "";

			// idbarang
			$this->idbarang->LinkCustomAttributes = "";
			$this->idbarang->HrefValue = "";

			// part
			$this->part->LinkCustomAttributes = "";
			$this->part->HrefValue = "";

			// lot
			$this->lot->LinkCustomAttributes = "";
			$this->lot->HrefValue = "";

			// qty_pp
			$this->qty_pp->LinkCustomAttributes = "";
			$this->qty_pp->HrefValue = "";

			// qty_acc
			$this->qty_acc->LinkCustomAttributes = "";
			$this->qty_acc->HrefValue = "";

			// id_satuan
			$this->id_satuan->LinkCustomAttributes = "";
			$this->id_satuan->HrefValue = "";

			// harga
			$this->harga->LinkCustomAttributes = "";
			$this->harga->HrefValue = "";

			// total
			$this->total->LinkCustomAttributes = "";
			$this->total->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// id_detailpp
			$this->id_detailpp->EditAttrs["class"] = "form-control";
			$this->id_detailpp->EditCustomAttributes = "";
			$this->id_detailpp->EditValue = $this->id_detailpp->CurrentValue;
			$this->id_detailpp->ViewCustomAttributes = "";

			// pid_pp
			$this->pid_pp->EditAttrs["class"] = "form-control";
			$this->pid_pp->EditCustomAttributes = "";
			if ($this->pid_pp->getSessionValue() != "") {
				$this->pid_pp->CurrentValue = $this->pid_pp->getSessionValue();
				$this->pid_pp->OldValue = $this->pid_pp->CurrentValue;
				$this->pid_pp->ViewValue = $this->pid_pp->CurrentValue;
				$this->pid_pp->ViewValue = FormatNumber($this->pid_pp->ViewValue, 0, -2, -2, -2);
				$this->pid_pp->ViewCustomAttributes = "";
			} else {
				$this->pid_pp->EditValue = HtmlEncode($this->pid_pp->CurrentValue);
				$this->pid_pp->PlaceHolder = RemoveHtml($this->pid_pp->caption());
			}

			// idbarang
			$this->idbarang->EditAttrs["class"] = "form-control";
			$this->idbarang->EditCustomAttributes = "";
			$curVal = trim(strval($this->idbarang->CurrentValue));
			if ($curVal != "")
				$this->idbarang->ViewValue = $this->idbarang->lookupCacheOption($curVal);
			else
				$this->idbarang->ViewValue = $this->idbarang->Lookup !== NULL && is_array($this->idbarang->Lookup->Options) ? $curVal : NULL;
			if ($this->idbarang->ViewValue !== NULL) { // Load from cache
				$this->idbarang->EditValue = array_values($this->idbarang->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->idbarang->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->idbarang->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->idbarang->EditValue = $arwrk;
			}

			// part
			$this->part->EditAttrs["class"] = "form-control";
			$this->part->EditCustomAttributes = "";
			if (!$this->part->Raw)
				$this->part->CurrentValue = HtmlDecode($this->part->CurrentValue);
			$this->part->EditValue = HtmlEncode($this->part->CurrentValue);
			$this->part->PlaceHolder = RemoveHtml($this->part->caption());

			// lot
			$this->lot->EditAttrs["class"] = "form-control";
			$this->lot->EditCustomAttributes = "";
			if (!$this->lot->Raw)
				$this->lot->CurrentValue = HtmlDecode($this->lot->CurrentValue);
			$this->lot->EditValue = HtmlEncode($this->lot->CurrentValue);
			$this->lot->PlaceHolder = RemoveHtml($this->lot->caption());

			// qty_pp
			$this->qty_pp->EditAttrs["class"] = "form-control";
			$this->qty_pp->EditCustomAttributes = "";
			$this->qty_pp->EditValue = HtmlEncode($this->qty_pp->CurrentValue);
			$this->qty_pp->PlaceHolder = RemoveHtml($this->qty_pp->caption());

			// qty_acc
			$this->qty_acc->EditAttrs["class"] = "form-control";
			$this->qty_acc->EditCustomAttributes = "";
			$this->qty_acc->EditValue = HtmlEncode($this->qty_acc->CurrentValue);
			$this->qty_acc->PlaceHolder = RemoveHtml($this->qty_acc->caption());

			// id_satuan
			$this->id_satuan->EditAttrs["class"] = "form-control";
			$this->id_satuan->EditCustomAttributes = "";
			$curVal = trim(strval($this->id_satuan->CurrentValue));
			if ($curVal != "")
				$this->id_satuan->ViewValue = $this->id_satuan->lookupCacheOption($curVal);
			else
				$this->id_satuan->ViewValue = $this->id_satuan->Lookup !== NULL && is_array($this->id_satuan->Lookup->Options) ? $curVal : NULL;
			if ($this->id_satuan->ViewValue !== NULL) { // Load from cache
				$this->id_satuan->EditValue = array_values($this->id_satuan->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_satuan`" . SearchString("=", $this->id_satuan->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->id_satuan->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->id_satuan->EditValue = $arwrk;
			}

			// harga
			$this->harga->EditAttrs["class"] = "form-control";
			$this->harga->EditCustomAttributes = "";
			$this->harga->EditValue = HtmlEncode($this->harga->CurrentValue);
			$this->harga->PlaceHolder = RemoveHtml($this->harga->caption());
			if (strval($this->harga->EditValue) != "" && is_numeric($this->harga->EditValue)) {
				$this->harga->EditValue = FormatNumber($this->harga->EditValue, -2, -2, -2, -2);
				$this->harga->OldValue = $this->harga->EditValue;
			}
			

			// total
			$this->total->EditAttrs["class"] = "form-control";
			$this->total->EditCustomAttributes = "";
			$this->total->EditValue = HtmlEncode($this->total->CurrentValue);
			$this->total->PlaceHolder = RemoveHtml($this->total->caption());
			if (strval($this->total->EditValue) != "" && is_numeric($this->total->EditValue)) {
				$this->total->EditValue = FormatNumber($this->total->EditValue, -2, -2, -2, -2);
				$this->total->OldValue = $this->total->EditValue;
			}
			

			// Edit refer script
			// id_detailpp

			$this->id_detailpp->LinkCustomAttributes = "";
			$this->id_detailpp->HrefValue = "";

			// pid_pp
			$this->pid_pp->LinkCustomAttributes = "";
			$this->pid_pp->HrefValue = "";

			// idbarang
			$this->idbarang->LinkCustomAttributes = "";
			$this->idbarang->HrefValue = "";

			// part
			$this->part->LinkCustomAttributes = "";
			$this->part->HrefValue = "";

			// lot
			$this->lot->LinkCustomAttributes = "";
			$this->lot->HrefValue = "";

			// qty_pp
			$this->qty_pp->LinkCustomAttributes = "";
			$this->qty_pp->HrefValue = "";

			// qty_acc
			$this->qty_acc->LinkCustomAttributes = "";
			$this->qty_acc->HrefValue = "";

			// id_satuan
			$this->id_satuan->LinkCustomAttributes = "";
			$this->id_satuan->HrefValue = "";

			// harga
			$this->harga->LinkCustomAttributes = "";
			$this->harga->HrefValue = "";

			// total
			$this->total->LinkCustomAttributes = "";
			$this->total->HrefValue = "";
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

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->id_detailpp->Required) {
			if (!$this->id_detailpp->IsDetailKey && $this->id_detailpp->FormValue != NULL && $this->id_detailpp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_detailpp->caption(), $this->id_detailpp->RequiredErrorMessage));
			}
		}
		if ($this->pid_pp->Required) {
			if (!$this->pid_pp->IsDetailKey && $this->pid_pp->FormValue != NULL && $this->pid_pp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->pid_pp->caption(), $this->pid_pp->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->pid_pp->FormValue)) {
			AddMessage($FormError, $this->pid_pp->errorMessage());
		}
		if ($this->idbarang->Required) {
			if (!$this->idbarang->IsDetailKey && $this->idbarang->FormValue != NULL && $this->idbarang->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->idbarang->caption(), $this->idbarang->RequiredErrorMessage));
			}
		}
		if ($this->part->Required) {
			if (!$this->part->IsDetailKey && $this->part->FormValue != NULL && $this->part->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->part->caption(), $this->part->RequiredErrorMessage));
			}
		}
		if ($this->lot->Required) {
			if (!$this->lot->IsDetailKey && $this->lot->FormValue != NULL && $this->lot->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->lot->caption(), $this->lot->RequiredErrorMessage));
			}
		}
		if ($this->qty_pp->Required) {
			if (!$this->qty_pp->IsDetailKey && $this->qty_pp->FormValue != NULL && $this->qty_pp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->qty_pp->caption(), $this->qty_pp->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->qty_pp->FormValue)) {
			AddMessage($FormError, $this->qty_pp->errorMessage());
		}
		if ($this->qty_acc->Required) {
			if (!$this->qty_acc->IsDetailKey && $this->qty_acc->FormValue != NULL && $this->qty_acc->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->qty_acc->caption(), $this->qty_acc->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->qty_acc->FormValue)) {
			AddMessage($FormError, $this->qty_acc->errorMessage());
		}
		if ($this->id_satuan->Required) {
			if (!$this->id_satuan->IsDetailKey && $this->id_satuan->FormValue != NULL && $this->id_satuan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_satuan->caption(), $this->id_satuan->RequiredErrorMessage));
			}
		}
		if ($this->harga->Required) {
			if (!$this->harga->IsDetailKey && $this->harga->FormValue != NULL && $this->harga->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->harga->caption(), $this->harga->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->harga->FormValue)) {
			AddMessage($FormError, $this->harga->errorMessage());
		}
		if ($this->total->Required) {
			if (!$this->total->IsDetailKey && $this->total->FormValue != NULL && $this->total->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->total->caption(), $this->total->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->total->FormValue)) {
			AddMessage($FormError, $this->total->errorMessage());
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

	// Delete records based on current filter
	protected function deleteRows()
	{
		global $Language, $Security;
		if (!$Security->canDelete()) {
			$this->setFailureMessage($Language->phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$deleteRows = TRUE;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
			$rs->close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->getRows() : [];

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->close();

		// Call row deleting event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$deleteRows = $this->Row_Deleting($row);
				if (!$deleteRows)
					break;
			}
		}
		if ($deleteRows) {
			$key = "";
			foreach ($rsold as $row) {
				$thisKey = "";
				if ($thisKey != "")
					$thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
				$thisKey .= $row['id_detailpp'];
				if (Config("DELETE_UPLOADED_FILES")) // Delete old files
					$this->deleteUploadedFiles($row);
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				$deleteRows = $this->delete($row); // Delete
				$conn->raiseErrorFn = "";
				if ($deleteRows === FALSE)
					break;
				if ($key != "")
					$key .= ", ";
				$key .= $thisKey;
			}
		}
		if (!$deleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("DeleteCancelled"));
			}
		}

		// Call Row Deleted event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}

		// Write JSON for API request (Support single row only)
		if (IsApi() && $deleteRows) {
			$row = $this->getRecordsFromRecordset($rsold, TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $deleteRows;
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

			// pid_pp
			$this->pid_pp->setDbValueDef($rsnew, $this->pid_pp->CurrentValue, NULL, $this->pid_pp->ReadOnly);

			// idbarang
			$this->idbarang->setDbValueDef($rsnew, $this->idbarang->CurrentValue, NULL, $this->idbarang->ReadOnly);

			// part
			$this->part->setDbValueDef($rsnew, $this->part->CurrentValue, NULL, $this->part->ReadOnly);

			// lot
			$this->lot->setDbValueDef($rsnew, $this->lot->CurrentValue, NULL, $this->lot->ReadOnly);

			// qty_pp
			$this->qty_pp->setDbValueDef($rsnew, $this->qty_pp->CurrentValue, NULL, $this->qty_pp->ReadOnly);

			// qty_acc
			$this->qty_acc->setDbValueDef($rsnew, $this->qty_acc->CurrentValue, NULL, $this->qty_acc->ReadOnly);

			// id_satuan
			$this->id_satuan->setDbValueDef($rsnew, $this->id_satuan->CurrentValue, NULL, $this->id_satuan->ReadOnly);

			// harga
			$this->harga->setDbValueDef($rsnew, $this->harga->CurrentValue, NULL, $this->harga->ReadOnly);

			// total
			$this->total->setDbValueDef($rsnew, $this->total->CurrentValue, NULL, $this->total->ReadOnly);

			// Check referential integrity for master table 'permintaanpembelian'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_permintaanpembelian();
			$keyValue = isset($rsnew['pid_pp']) ? $rsnew['pid_pp'] : $rsold['pid_pp'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@id_pp@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["permintaanpembelian"]))
					$GLOBALS["permintaanpembelian"] = new permintaanpembelian();
				$rsmaster = $GLOBALS["permintaanpembelian"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "permintaanpembelian", $Language->phrase("RelatedRecordRequired"));
				$this->setFailureMessage($relatedRecordMsg);
				$rs->close();
				return FALSE;
			}

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

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;

		// Set up foreign key field value from Session
			if ($this->getCurrentMasterTable() == "permintaanpembelian") {
				$this->pid_pp->CurrentValue = $this->pid_pp->getSessionValue();
			}

		// Check referential integrity for master table 'detailmintapembelian'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_permintaanpembelian();
		if (strval($this->pid_pp->CurrentValue) != "") {
			$masterFilter = str_replace("@id_pp@", AdjustSql($this->pid_pp->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["permintaanpembelian"]))
				$GLOBALS["permintaanpembelian"] = new permintaanpembelian();
			$rsmaster = $GLOBALS["permintaanpembelian"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "permintaanpembelian", $Language->phrase("RelatedRecordRequired"));
			$this->setFailureMessage($relatedRecordMsg);
			return FALSE;
		}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// pid_pp
		$this->pid_pp->setDbValueDef($rsnew, $this->pid_pp->CurrentValue, NULL, FALSE);

		// idbarang
		$this->idbarang->setDbValueDef($rsnew, $this->idbarang->CurrentValue, NULL, FALSE);

		// part
		$this->part->setDbValueDef($rsnew, $this->part->CurrentValue, NULL, FALSE);

		// lot
		$this->lot->setDbValueDef($rsnew, $this->lot->CurrentValue, NULL, FALSE);

		// qty_pp
		$this->qty_pp->setDbValueDef($rsnew, $this->qty_pp->CurrentValue, NULL, FALSE);

		// qty_acc
		$this->qty_acc->setDbValueDef($rsnew, $this->qty_acc->CurrentValue, NULL, FALSE);

		// id_satuan
		$this->id_satuan->setDbValueDef($rsnew, $this->id_satuan->CurrentValue, NULL, FALSE);

		// harga
		$this->harga->setDbValueDef($rsnew, $this->harga->CurrentValue, NULL, FALSE);

		// total
		$this->total->setDbValueDef($rsnew, $this->total->CurrentValue, NULL, FALSE);

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

		// Hide foreign keys
		$masterTblVar = $this->getCurrentMasterTable();
		if ($masterTblVar == "permintaanpembelian") {
			$this->pid_pp->Visible = FALSE;
			if ($GLOBALS["permintaanpembelian"]->EventCancelled)
				$this->EventCancelled = TRUE;
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
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
				case "x_idbarang":
					break;
				case "x_id_satuan":
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
						case "x_idbarang":
							break;
						case "x_id_satuan":
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

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendering event
	function ListOptions_Rendering() {

		//$GLOBALS["xxx_grid"]->DetailAdd = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailEdit = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailView = (...condition...); // Set to TRUE or FALSE conditionally

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example:
		//$this->ListOptions["new"]->Body = "xxx";

	}
} // End class
?>