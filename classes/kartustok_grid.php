<?php
namespace PHPMaker2020\sim_klinik_alamanda;

/**
 * Page class
 */
class kartustok_grid extends kartustok
{

	// Page ID
	public $PageID = "grid";

	// Project ID
	public $ProjectID = "{8546B030-7993-4749-BFDB-17AFAAF4065D}";

	// Table name
	public $TableName = 'kartustok';

	// Page object name
	public $PageObjName = "kartustok_grid";

	// Grid form hidden field names
	public $FormName = "fkartustokgrid";
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

		// Table object (kartustok)
		if (!isset($GLOBALS["kartustok"]) || get_class($GLOBALS["kartustok"]) == PROJECT_NAMESPACE . "kartustok") {
			$GLOBALS["kartustok"] = &$this;

			// $GLOBALS["MasterTable"] = &$GLOBALS["Table"];
			// if (!isset($GLOBALS["Table"]))
			// 	$GLOBALS["Table"] = &$GLOBALS["kartustok"];

		}
		$this->AddUrl = "kartustokadd.php";

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'grid');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'kartustok');

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
		global $kartustok;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($kartustok);
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
			$key .= @$ar['id_kartustok'];
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
			$this->id_kartustok->Visible = FALSE;
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
		$this->id_kartustok->Visible = FALSE;
		$this->id_barang->setVisibility();
		$this->id_klinik->setVisibility();
		$this->tanggal->setVisibility();
		$this->id_terimabarang->setVisibility();
		$this->id_terimagudang->setVisibility();
		$this->id_penjualan->setVisibility();
		$this->id_kirimbarang->setVisibility();
		$this->id_nonjual->Visible = FALSE;
		$this->id_retur->setVisibility();
		$this->id_penyesuaian->setVisibility();
		$this->stok_awal->setVisibility();
		$this->masuk->setVisibility();
		$this->masuk_penyesuaian->setVisibility();
		$this->keluar->setVisibility();
		$this->keluar_nonjual->setVisibility();
		$this->keluar_penyesuaian->setVisibility();
		$this->keluar_kirim->setVisibility();
		$this->retur->setVisibility();
		$this->stok_akhir->setVisibility();
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
		$this->setupLookupOptions($this->id_barang);
		$this->setupLookupOptions($this->id_klinik);
		$this->setupLookupOptions($this->id_terimabarang);
		$this->setupLookupOptions($this->id_terimagudang);
		$this->setupLookupOptions($this->id_penjualan);
		$this->setupLookupOptions($this->id_kirimbarang);
		$this->setupLookupOptions($this->id_nonjual);
		$this->setupLookupOptions($this->id_retur);
		$this->setupLookupOptions($this->id_penyesuaian);

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
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "V_kartustok") {
			global $V_kartustok;
			$rsmaster = $V_kartustok->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("V_kartustoklist.php"); // Return to master page
			} else {
				$V_kartustok->loadListRowValues($rsmaster);
				$V_kartustok->RowType = ROWTYPE_MASTER; // Master row
				$V_kartustok->renderListRow();
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
		$this->stok_awal->FormValue = ""; // Clear form value
		$this->masuk->FormValue = ""; // Clear form value
		$this->masuk_penyesuaian->FormValue = ""; // Clear form value
		$this->keluar->FormValue = ""; // Clear form value
		$this->keluar_nonjual->FormValue = ""; // Clear form value
		$this->keluar_penyesuaian->FormValue = ""; // Clear form value
		$this->keluar_kirim->FormValue = ""; // Clear form value
		$this->retur->FormValue = ""; // Clear form value
		$this->stok_akhir->FormValue = ""; // Clear form value
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
			$this->id_kartustok->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->id_kartustok->OldValue))
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
					$key .= $this->id_kartustok->CurrentValue;

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
		if ($CurrentForm->hasValue("x_id_barang") && $CurrentForm->hasValue("o_id_barang") && $this->id_barang->CurrentValue != $this->id_barang->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_id_klinik") && $CurrentForm->hasValue("o_id_klinik") && $this->id_klinik->CurrentValue != $this->id_klinik->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_tanggal") && $CurrentForm->hasValue("o_tanggal") && $this->tanggal->CurrentValue != $this->tanggal->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_id_terimabarang") && $CurrentForm->hasValue("o_id_terimabarang") && $this->id_terimabarang->CurrentValue != $this->id_terimabarang->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_id_terimagudang") && $CurrentForm->hasValue("o_id_terimagudang") && $this->id_terimagudang->CurrentValue != $this->id_terimagudang->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_id_penjualan") && $CurrentForm->hasValue("o_id_penjualan") && $this->id_penjualan->CurrentValue != $this->id_penjualan->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_id_kirimbarang") && $CurrentForm->hasValue("o_id_kirimbarang") && $this->id_kirimbarang->CurrentValue != $this->id_kirimbarang->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_id_retur") && $CurrentForm->hasValue("o_id_retur") && $this->id_retur->CurrentValue != $this->id_retur->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_id_penyesuaian") && $CurrentForm->hasValue("o_id_penyesuaian") && $this->id_penyesuaian->CurrentValue != $this->id_penyesuaian->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_stok_awal") && $CurrentForm->hasValue("o_stok_awal") && $this->stok_awal->CurrentValue != $this->stok_awal->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_masuk") && $CurrentForm->hasValue("o_masuk") && $this->masuk->CurrentValue != $this->masuk->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_masuk_penyesuaian") && $CurrentForm->hasValue("o_masuk_penyesuaian") && $this->masuk_penyesuaian->CurrentValue != $this->masuk_penyesuaian->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_keluar") && $CurrentForm->hasValue("o_keluar") && $this->keluar->CurrentValue != $this->keluar->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_keluar_nonjual") && $CurrentForm->hasValue("o_keluar_nonjual") && $this->keluar_nonjual->CurrentValue != $this->keluar_nonjual->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_keluar_penyesuaian") && $CurrentForm->hasValue("o_keluar_penyesuaian") && $this->keluar_penyesuaian->CurrentValue != $this->keluar_penyesuaian->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_keluar_kirim") && $CurrentForm->hasValue("o_keluar_kirim") && $this->keluar_kirim->CurrentValue != $this->keluar_kirim->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_retur") && $CurrentForm->hasValue("o_retur") && $this->retur->CurrentValue != $this->retur->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_stok_akhir") && $CurrentForm->hasValue("o_stok_akhir") && $this->stok_akhir->CurrentValue != $this->stok_akhir->OldValue)
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
				$this->id_barang->setSessionValue("");
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
			if (IsMobile())
				$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode($this->ViewUrl) . "\">" . $Language->phrase("ViewLink") . "</a>";
			else
				$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-table=\"kartustok\" data-caption=\"" . $viewcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->ViewUrl) . "',btn:null});\">" . $Language->phrase("ViewLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "edit"
		$opt = $this->ListOptions["edit"];
		$editcaption = HtmlTitle($Language->phrase("EditLink"));
		if ($Security->canEdit()) {
			if (IsMobile())
				$opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->phrase("EditLink") . "</a>";
			else
				$opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . $editcaption . "\" data-table=\"kartustok\" data-caption=\"" . $editcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'SaveBtn',url:'" . HtmlEncode($this->EditUrl) . "'});\">" . $Language->phrase("EditLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "copy"
		$opt = $this->ListOptions["copy"];
		$copycaption = HtmlTitle($Language->phrase("CopyLink"));
		if ($Security->canAdd()) {
			if (IsMobile())
				$opt->Body = "<a class=\"ew-row-link ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode($this->CopyUrl) . "\">" . $Language->phrase("CopyLink") . "</a>";
			else
				$opt->Body = "<a class=\"ew-row-link ew-copy\" title=\"" . $copycaption . "\" data-table=\"kartustok\" data-caption=\"" . $copycaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'AddBtn',url:'" . HtmlEncode($this->CopyUrl) . "'});\">" . $Language->phrase("CopyLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "delete"
		$opt = $this->ListOptions["delete"];
		if ($Security->canDelete())
			$opt->Body = "<a class=\"ew-row-link ew-delete\"" . " onclick=\"return ew.confirmDelete(this);\"" . " title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" href=\"" . HtmlEncode($this->DeleteUrl) . "\">" . $Language->phrase("DeleteLink") . "</a>";
		else
			$opt->Body = "";
		} // End View mode
		if ($this->CurrentMode == "edit" && is_numeric($this->RowIndex) && $this->RowAction != "delete") {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->id_kartustok->CurrentValue . "\">";
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
		$key .= $rs->fields('id_kartustok');
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
			if (IsMobile())
				$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("AddLink") . "</a>";
			else
				$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-table=\"kartustok\" data-caption=\"" . $addcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'AddBtn',url:'" . HtmlEncode($this->AddUrl) . "'});\">" . $Language->phrase("AddLink") . "</a>";
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
		$this->id_kartustok->CurrentValue = NULL;
		$this->id_kartustok->OldValue = $this->id_kartustok->CurrentValue;
		$this->id_barang->CurrentValue = NULL;
		$this->id_barang->OldValue = $this->id_barang->CurrentValue;
		$this->id_klinik->CurrentValue = NULL;
		$this->id_klinik->OldValue = $this->id_klinik->CurrentValue;
		$this->tanggal->CurrentValue = NULL;
		$this->tanggal->OldValue = $this->tanggal->CurrentValue;
		$this->id_terimabarang->CurrentValue = NULL;
		$this->id_terimabarang->OldValue = $this->id_terimabarang->CurrentValue;
		$this->id_terimagudang->CurrentValue = NULL;
		$this->id_terimagudang->OldValue = $this->id_terimagudang->CurrentValue;
		$this->id_penjualan->CurrentValue = NULL;
		$this->id_penjualan->OldValue = $this->id_penjualan->CurrentValue;
		$this->id_kirimbarang->CurrentValue = NULL;
		$this->id_kirimbarang->OldValue = $this->id_kirimbarang->CurrentValue;
		$this->id_nonjual->CurrentValue = NULL;
		$this->id_nonjual->OldValue = $this->id_nonjual->CurrentValue;
		$this->id_retur->CurrentValue = NULL;
		$this->id_retur->OldValue = $this->id_retur->CurrentValue;
		$this->id_penyesuaian->CurrentValue = NULL;
		$this->id_penyesuaian->OldValue = $this->id_penyesuaian->CurrentValue;
		$this->stok_awal->CurrentValue = NULL;
		$this->stok_awal->OldValue = $this->stok_awal->CurrentValue;
		$this->masuk->CurrentValue = NULL;
		$this->masuk->OldValue = $this->masuk->CurrentValue;
		$this->masuk_penyesuaian->CurrentValue = NULL;
		$this->masuk_penyesuaian->OldValue = $this->masuk_penyesuaian->CurrentValue;
		$this->keluar->CurrentValue = NULL;
		$this->keluar->OldValue = $this->keluar->CurrentValue;
		$this->keluar_nonjual->CurrentValue = NULL;
		$this->keluar_nonjual->OldValue = $this->keluar_nonjual->CurrentValue;
		$this->keluar_penyesuaian->CurrentValue = NULL;
		$this->keluar_penyesuaian->OldValue = $this->keluar_penyesuaian->CurrentValue;
		$this->keluar_kirim->CurrentValue = NULL;
		$this->keluar_kirim->OldValue = $this->keluar_kirim->CurrentValue;
		$this->retur->CurrentValue = NULL;
		$this->retur->OldValue = $this->retur->CurrentValue;
		$this->stok_akhir->CurrentValue = NULL;
		$this->stok_akhir->OldValue = $this->stok_akhir->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$CurrentForm->FormName = $this->FormName;

		// Check field name 'id_barang' first before field var 'x_id_barang'
		$val = $CurrentForm->hasValue("id_barang") ? $CurrentForm->getValue("id_barang") : $CurrentForm->getValue("x_id_barang");
		if (!$this->id_barang->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_barang->Visible = FALSE; // Disable update for API request
			else
				$this->id_barang->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_id_barang"))
			$this->id_barang->setOldValue($CurrentForm->getValue("o_id_barang"));

		// Check field name 'id_klinik' first before field var 'x_id_klinik'
		$val = $CurrentForm->hasValue("id_klinik") ? $CurrentForm->getValue("id_klinik") : $CurrentForm->getValue("x_id_klinik");
		if (!$this->id_klinik->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_klinik->Visible = FALSE; // Disable update for API request
			else
				$this->id_klinik->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_id_klinik"))
			$this->id_klinik->setOldValue($CurrentForm->getValue("o_id_klinik"));

		// Check field name 'tanggal' first before field var 'x_tanggal'
		$val = $CurrentForm->hasValue("tanggal") ? $CurrentForm->getValue("tanggal") : $CurrentForm->getValue("x_tanggal");
		if (!$this->tanggal->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tanggal->Visible = FALSE; // Disable update for API request
			else
				$this->tanggal->setFormValue($val);
			$this->tanggal->CurrentValue = UnFormatDateTime($this->tanggal->CurrentValue, 0);
		}
		if ($CurrentForm->hasValue("o_tanggal"))
			$this->tanggal->setOldValue($CurrentForm->getValue("o_tanggal"));

		// Check field name 'id_terimabarang' first before field var 'x_id_terimabarang'
		$val = $CurrentForm->hasValue("id_terimabarang") ? $CurrentForm->getValue("id_terimabarang") : $CurrentForm->getValue("x_id_terimabarang");
		if (!$this->id_terimabarang->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_terimabarang->Visible = FALSE; // Disable update for API request
			else
				$this->id_terimabarang->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_id_terimabarang"))
			$this->id_terimabarang->setOldValue($CurrentForm->getValue("o_id_terimabarang"));

		// Check field name 'id_terimagudang' first before field var 'x_id_terimagudang'
		$val = $CurrentForm->hasValue("id_terimagudang") ? $CurrentForm->getValue("id_terimagudang") : $CurrentForm->getValue("x_id_terimagudang");
		if (!$this->id_terimagudang->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_terimagudang->Visible = FALSE; // Disable update for API request
			else
				$this->id_terimagudang->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_id_terimagudang"))
			$this->id_terimagudang->setOldValue($CurrentForm->getValue("o_id_terimagudang"));

		// Check field name 'id_penjualan' first before field var 'x_id_penjualan'
		$val = $CurrentForm->hasValue("id_penjualan") ? $CurrentForm->getValue("id_penjualan") : $CurrentForm->getValue("x_id_penjualan");
		if (!$this->id_penjualan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_penjualan->Visible = FALSE; // Disable update for API request
			else
				$this->id_penjualan->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_id_penjualan"))
			$this->id_penjualan->setOldValue($CurrentForm->getValue("o_id_penjualan"));

		// Check field name 'id_kirimbarang' first before field var 'x_id_kirimbarang'
		$val = $CurrentForm->hasValue("id_kirimbarang") ? $CurrentForm->getValue("id_kirimbarang") : $CurrentForm->getValue("x_id_kirimbarang");
		if (!$this->id_kirimbarang->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_kirimbarang->Visible = FALSE; // Disable update for API request
			else
				$this->id_kirimbarang->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_id_kirimbarang"))
			$this->id_kirimbarang->setOldValue($CurrentForm->getValue("o_id_kirimbarang"));

		// Check field name 'id_retur' first before field var 'x_id_retur'
		$val = $CurrentForm->hasValue("id_retur") ? $CurrentForm->getValue("id_retur") : $CurrentForm->getValue("x_id_retur");
		if (!$this->id_retur->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_retur->Visible = FALSE; // Disable update for API request
			else
				$this->id_retur->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_id_retur"))
			$this->id_retur->setOldValue($CurrentForm->getValue("o_id_retur"));

		// Check field name 'id_penyesuaian' first before field var 'x_id_penyesuaian'
		$val = $CurrentForm->hasValue("id_penyesuaian") ? $CurrentForm->getValue("id_penyesuaian") : $CurrentForm->getValue("x_id_penyesuaian");
		if (!$this->id_penyesuaian->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_penyesuaian->Visible = FALSE; // Disable update for API request
			else
				$this->id_penyesuaian->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_id_penyesuaian"))
			$this->id_penyesuaian->setOldValue($CurrentForm->getValue("o_id_penyesuaian"));

		// Check field name 'stok_awal' first before field var 'x_stok_awal'
		$val = $CurrentForm->hasValue("stok_awal") ? $CurrentForm->getValue("stok_awal") : $CurrentForm->getValue("x_stok_awal");
		if (!$this->stok_awal->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->stok_awal->Visible = FALSE; // Disable update for API request
			else
				$this->stok_awal->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_stok_awal"))
			$this->stok_awal->setOldValue($CurrentForm->getValue("o_stok_awal"));

		// Check field name 'masuk' first before field var 'x_masuk'
		$val = $CurrentForm->hasValue("masuk") ? $CurrentForm->getValue("masuk") : $CurrentForm->getValue("x_masuk");
		if (!$this->masuk->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->masuk->Visible = FALSE; // Disable update for API request
			else
				$this->masuk->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_masuk"))
			$this->masuk->setOldValue($CurrentForm->getValue("o_masuk"));

		// Check field name 'masuk_penyesuaian' first before field var 'x_masuk_penyesuaian'
		$val = $CurrentForm->hasValue("masuk_penyesuaian") ? $CurrentForm->getValue("masuk_penyesuaian") : $CurrentForm->getValue("x_masuk_penyesuaian");
		if (!$this->masuk_penyesuaian->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->masuk_penyesuaian->Visible = FALSE; // Disable update for API request
			else
				$this->masuk_penyesuaian->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_masuk_penyesuaian"))
			$this->masuk_penyesuaian->setOldValue($CurrentForm->getValue("o_masuk_penyesuaian"));

		// Check field name 'keluar' first before field var 'x_keluar'
		$val = $CurrentForm->hasValue("keluar") ? $CurrentForm->getValue("keluar") : $CurrentForm->getValue("x_keluar");
		if (!$this->keluar->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->keluar->Visible = FALSE; // Disable update for API request
			else
				$this->keluar->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_keluar"))
			$this->keluar->setOldValue($CurrentForm->getValue("o_keluar"));

		// Check field name 'keluar_nonjual' first before field var 'x_keluar_nonjual'
		$val = $CurrentForm->hasValue("keluar_nonjual") ? $CurrentForm->getValue("keluar_nonjual") : $CurrentForm->getValue("x_keluar_nonjual");
		if (!$this->keluar_nonjual->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->keluar_nonjual->Visible = FALSE; // Disable update for API request
			else
				$this->keluar_nonjual->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_keluar_nonjual"))
			$this->keluar_nonjual->setOldValue($CurrentForm->getValue("o_keluar_nonjual"));

		// Check field name 'keluar_penyesuaian' first before field var 'x_keluar_penyesuaian'
		$val = $CurrentForm->hasValue("keluar_penyesuaian") ? $CurrentForm->getValue("keluar_penyesuaian") : $CurrentForm->getValue("x_keluar_penyesuaian");
		if (!$this->keluar_penyesuaian->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->keluar_penyesuaian->Visible = FALSE; // Disable update for API request
			else
				$this->keluar_penyesuaian->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_keluar_penyesuaian"))
			$this->keluar_penyesuaian->setOldValue($CurrentForm->getValue("o_keluar_penyesuaian"));

		// Check field name 'keluar_kirim' first before field var 'x_keluar_kirim'
		$val = $CurrentForm->hasValue("keluar_kirim") ? $CurrentForm->getValue("keluar_kirim") : $CurrentForm->getValue("x_keluar_kirim");
		if (!$this->keluar_kirim->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->keluar_kirim->Visible = FALSE; // Disable update for API request
			else
				$this->keluar_kirim->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_keluar_kirim"))
			$this->keluar_kirim->setOldValue($CurrentForm->getValue("o_keluar_kirim"));

		// Check field name 'retur' first before field var 'x_retur'
		$val = $CurrentForm->hasValue("retur") ? $CurrentForm->getValue("retur") : $CurrentForm->getValue("x_retur");
		if (!$this->retur->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->retur->Visible = FALSE; // Disable update for API request
			else
				$this->retur->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_retur"))
			$this->retur->setOldValue($CurrentForm->getValue("o_retur"));

		// Check field name 'stok_akhir' first before field var 'x_stok_akhir'
		$val = $CurrentForm->hasValue("stok_akhir") ? $CurrentForm->getValue("stok_akhir") : $CurrentForm->getValue("x_stok_akhir");
		if (!$this->stok_akhir->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->stok_akhir->Visible = FALSE; // Disable update for API request
			else
				$this->stok_akhir->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_stok_akhir"))
			$this->stok_akhir->setOldValue($CurrentForm->getValue("o_stok_akhir"));

		// Check field name 'id_kartustok' first before field var 'x_id_kartustok'
		$val = $CurrentForm->hasValue("id_kartustok") ? $CurrentForm->getValue("id_kartustok") : $CurrentForm->getValue("x_id_kartustok");
		if (!$this->id_kartustok->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->id_kartustok->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->id_kartustok->CurrentValue = $this->id_kartustok->FormValue;
		$this->id_barang->CurrentValue = $this->id_barang->FormValue;
		$this->id_klinik->CurrentValue = $this->id_klinik->FormValue;
		$this->tanggal->CurrentValue = $this->tanggal->FormValue;
		$this->tanggal->CurrentValue = UnFormatDateTime($this->tanggal->CurrentValue, 0);
		$this->id_terimabarang->CurrentValue = $this->id_terimabarang->FormValue;
		$this->id_terimagudang->CurrentValue = $this->id_terimagudang->FormValue;
		$this->id_penjualan->CurrentValue = $this->id_penjualan->FormValue;
		$this->id_kirimbarang->CurrentValue = $this->id_kirimbarang->FormValue;
		$this->id_retur->CurrentValue = $this->id_retur->FormValue;
		$this->id_penyesuaian->CurrentValue = $this->id_penyesuaian->FormValue;
		$this->stok_awal->CurrentValue = $this->stok_awal->FormValue;
		$this->masuk->CurrentValue = $this->masuk->FormValue;
		$this->masuk_penyesuaian->CurrentValue = $this->masuk_penyesuaian->FormValue;
		$this->keluar->CurrentValue = $this->keluar->FormValue;
		$this->keluar_nonjual->CurrentValue = $this->keluar_nonjual->FormValue;
		$this->keluar_penyesuaian->CurrentValue = $this->keluar_penyesuaian->FormValue;
		$this->keluar_kirim->CurrentValue = $this->keluar_kirim->FormValue;
		$this->retur->CurrentValue = $this->retur->FormValue;
		$this->stok_akhir->CurrentValue = $this->stok_akhir->FormValue;
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
		$this->id_kartustok->setDbValue($row['id_kartustok']);
		$this->id_barang->setDbValue($row['id_barang']);
		$this->id_klinik->setDbValue($row['id_klinik']);
		$this->tanggal->setDbValue($row['tanggal']);
		$this->id_terimabarang->setDbValue($row['id_terimabarang']);
		$this->id_terimagudang->setDbValue($row['id_terimagudang']);
		$this->id_penjualan->setDbValue($row['id_penjualan']);
		$this->id_kirimbarang->setDbValue($row['id_kirimbarang']);
		$this->id_nonjual->setDbValue($row['id_nonjual']);
		$this->id_retur->setDbValue($row['id_retur']);
		$this->id_penyesuaian->setDbValue($row['id_penyesuaian']);
		$this->stok_awal->setDbValue($row['stok_awal']);
		$this->masuk->setDbValue($row['masuk']);
		$this->masuk_penyesuaian->setDbValue($row['masuk_penyesuaian']);
		$this->keluar->setDbValue($row['keluar']);
		$this->keluar_nonjual->setDbValue($row['keluar_nonjual']);
		$this->keluar_penyesuaian->setDbValue($row['keluar_penyesuaian']);
		$this->keluar_kirim->setDbValue($row['keluar_kirim']);
		$this->retur->setDbValue($row['retur']);
		$this->stok_akhir->setDbValue($row['stok_akhir']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id_kartustok'] = $this->id_kartustok->CurrentValue;
		$row['id_barang'] = $this->id_barang->CurrentValue;
		$row['id_klinik'] = $this->id_klinik->CurrentValue;
		$row['tanggal'] = $this->tanggal->CurrentValue;
		$row['id_terimabarang'] = $this->id_terimabarang->CurrentValue;
		$row['id_terimagudang'] = $this->id_terimagudang->CurrentValue;
		$row['id_penjualan'] = $this->id_penjualan->CurrentValue;
		$row['id_kirimbarang'] = $this->id_kirimbarang->CurrentValue;
		$row['id_nonjual'] = $this->id_nonjual->CurrentValue;
		$row['id_retur'] = $this->id_retur->CurrentValue;
		$row['id_penyesuaian'] = $this->id_penyesuaian->CurrentValue;
		$row['stok_awal'] = $this->stok_awal->CurrentValue;
		$row['masuk'] = $this->masuk->CurrentValue;
		$row['masuk_penyesuaian'] = $this->masuk_penyesuaian->CurrentValue;
		$row['keluar'] = $this->keluar->CurrentValue;
		$row['keluar_nonjual'] = $this->keluar_nonjual->CurrentValue;
		$row['keluar_penyesuaian'] = $this->keluar_penyesuaian->CurrentValue;
		$row['keluar_kirim'] = $this->keluar_kirim->CurrentValue;
		$row['retur'] = $this->retur->CurrentValue;
		$row['stok_akhir'] = $this->stok_akhir->CurrentValue;
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
				$this->id_kartustok->OldValue = strval($keys[0]); // id_kartustok
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
		if ($this->stok_awal->FormValue == $this->stok_awal->CurrentValue && is_numeric(ConvertToFloatString($this->stok_awal->CurrentValue)))
			$this->stok_awal->CurrentValue = ConvertToFloatString($this->stok_awal->CurrentValue);

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
		if ($this->keluar_nonjual->FormValue == $this->keluar_nonjual->CurrentValue && is_numeric(ConvertToFloatString($this->keluar_nonjual->CurrentValue)))
			$this->keluar_nonjual->CurrentValue = ConvertToFloatString($this->keluar_nonjual->CurrentValue);

		// Convert decimal values if posted back
		if ($this->keluar_penyesuaian->FormValue == $this->keluar_penyesuaian->CurrentValue && is_numeric(ConvertToFloatString($this->keluar_penyesuaian->CurrentValue)))
			$this->keluar_penyesuaian->CurrentValue = ConvertToFloatString($this->keluar_penyesuaian->CurrentValue);

		// Convert decimal values if posted back
		if ($this->keluar_kirim->FormValue == $this->keluar_kirim->CurrentValue && is_numeric(ConvertToFloatString($this->keluar_kirim->CurrentValue)))
			$this->keluar_kirim->CurrentValue = ConvertToFloatString($this->keluar_kirim->CurrentValue);

		// Convert decimal values if posted back
		if ($this->retur->FormValue == $this->retur->CurrentValue && is_numeric(ConvertToFloatString($this->retur->CurrentValue)))
			$this->retur->CurrentValue = ConvertToFloatString($this->retur->CurrentValue);

		// Convert decimal values if posted back
		if ($this->stok_akhir->FormValue == $this->stok_akhir->CurrentValue && is_numeric(ConvertToFloatString($this->stok_akhir->CurrentValue)))
			$this->stok_akhir->CurrentValue = ConvertToFloatString($this->stok_akhir->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id_kartustok
		// id_barang
		// id_klinik
		// tanggal
		// id_terimabarang
		// id_terimagudang
		// id_penjualan
		// id_kirimbarang
		// id_nonjual
		// id_retur
		// id_penyesuaian
		// stok_awal
		// masuk
		// masuk_penyesuaian
		// keluar
		// keluar_nonjual
		// keluar_penyesuaian
		// keluar_kirim
		// retur
		// stok_akhir

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id_kartustok
			$this->id_kartustok->ViewValue = $this->id_kartustok->CurrentValue;
			$this->id_kartustok->ViewCustomAttributes = "";

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

			// tanggal
			$this->tanggal->ViewValue = $this->tanggal->CurrentValue;
			$this->tanggal->ViewValue = FormatDateTime($this->tanggal->ViewValue, 0);
			$this->tanggal->ViewCustomAttributes = "";

			// id_terimabarang
			$this->id_terimabarang->ViewValue = $this->id_terimabarang->CurrentValue;
			$curVal = strval($this->id_terimabarang->CurrentValue);
			if ($curVal != "") {
				$this->id_terimabarang->ViewValue = $this->id_terimabarang->lookupCacheOption($curVal);
				if ($this->id_terimabarang->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_terimabarang->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_terimabarang->ViewValue = $this->id_terimabarang->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_terimabarang->ViewValue = $this->id_terimabarang->CurrentValue;
					}
				}
			} else {
				$this->id_terimabarang->ViewValue = NULL;
			}
			$this->id_terimabarang->ViewCustomAttributes = "";

			// id_terimagudang
			$this->id_terimagudang->ViewValue = $this->id_terimagudang->CurrentValue;
			$curVal = strval($this->id_terimagudang->CurrentValue);
			if ($curVal != "") {
				$this->id_terimagudang->ViewValue = $this->id_terimagudang->lookupCacheOption($curVal);
				if ($this->id_terimagudang->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_terimagudang`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_terimagudang->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_terimagudang->ViewValue = $this->id_terimagudang->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_terimagudang->ViewValue = $this->id_terimagudang->CurrentValue;
					}
				}
			} else {
				$this->id_terimagudang->ViewValue = NULL;
			}
			$this->id_terimagudang->ViewCustomAttributes = "";

			// id_penjualan
			$this->id_penjualan->ViewValue = $this->id_penjualan->CurrentValue;
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

			// id_kirimbarang
			$this->id_kirimbarang->ViewValue = $this->id_kirimbarang->CurrentValue;
			$curVal = strval($this->id_kirimbarang->CurrentValue);
			if ($curVal != "") {
				$this->id_kirimbarang->ViewValue = $this->id_kirimbarang->lookupCacheOption($curVal);
				if ($this->id_kirimbarang->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_kirimbarang->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_kirimbarang->ViewValue = $this->id_kirimbarang->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_kirimbarang->ViewValue = $this->id_kirimbarang->CurrentValue;
					}
				}
			} else {
				$this->id_kirimbarang->ViewValue = NULL;
			}
			$this->id_kirimbarang->ViewCustomAttributes = "";

			// id_nonjual
			$this->id_nonjual->ViewValue = $this->id_nonjual->CurrentValue;
			$curVal = strval($this->id_nonjual->CurrentValue);
			if ($curVal != "") {
				$this->id_nonjual->ViewValue = $this->id_nonjual->lookupCacheOption($curVal);
				if ($this->id_nonjual->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_nonjual`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_nonjual->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_nonjual->ViewValue = $this->id_nonjual->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_nonjual->ViewValue = $this->id_nonjual->CurrentValue;
					}
				}
			} else {
				$this->id_nonjual->ViewValue = NULL;
			}
			$this->id_nonjual->ViewCustomAttributes = "";

			// id_retur
			$this->id_retur->ViewValue = $this->id_retur->CurrentValue;
			$curVal = strval($this->id_retur->CurrentValue);
			if ($curVal != "") {
				$this->id_retur->ViewValue = $this->id_retur->lookupCacheOption($curVal);
				if ($this->id_retur->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_retur`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_retur->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_retur->ViewValue = $this->id_retur->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_retur->ViewValue = $this->id_retur->CurrentValue;
					}
				}
			} else {
				$this->id_retur->ViewValue = NULL;
			}
			$this->id_retur->ViewCustomAttributes = "";

			// id_penyesuaian
			$this->id_penyesuaian->ViewValue = $this->id_penyesuaian->CurrentValue;
			$curVal = strval($this->id_penyesuaian->CurrentValue);
			if ($curVal != "") {
				$this->id_penyesuaian->ViewValue = $this->id_penyesuaian->lookupCacheOption($curVal);
				if ($this->id_penyesuaian->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_penyesuaianstok`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_penyesuaian->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_penyesuaian->ViewValue = $this->id_penyesuaian->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_penyesuaian->ViewValue = $this->id_penyesuaian->CurrentValue;
					}
				}
			} else {
				$this->id_penyesuaian->ViewValue = NULL;
			}
			$this->id_penyesuaian->ViewCustomAttributes = "";

			// stok_awal
			$this->stok_awal->ViewValue = $this->stok_awal->CurrentValue;
			$this->stok_awal->ViewValue = FormatNumber($this->stok_awal->ViewValue, 2, -2, -2, -2);
			$this->stok_awal->ViewCustomAttributes = "";

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

			// keluar_nonjual
			$this->keluar_nonjual->ViewValue = $this->keluar_nonjual->CurrentValue;
			$this->keluar_nonjual->ViewValue = FormatNumber($this->keluar_nonjual->ViewValue, 2, -2, -2, -2);
			$this->keluar_nonjual->ViewCustomAttributes = "";

			// keluar_penyesuaian
			$this->keluar_penyesuaian->ViewValue = $this->keluar_penyesuaian->CurrentValue;
			$this->keluar_penyesuaian->ViewValue = FormatNumber($this->keluar_penyesuaian->ViewValue, 2, -2, -2, -2);
			$this->keluar_penyesuaian->ViewCustomAttributes = "";

			// keluar_kirim
			$this->keluar_kirim->ViewValue = $this->keluar_kirim->CurrentValue;
			$this->keluar_kirim->ViewValue = FormatNumber($this->keluar_kirim->ViewValue, 2, -2, -2, -2);
			$this->keluar_kirim->ViewCustomAttributes = "";

			// retur
			$this->retur->ViewValue = $this->retur->CurrentValue;
			$this->retur->ViewValue = FormatNumber($this->retur->ViewValue, 2, -2, -2, -2);
			$this->retur->ViewCustomAttributes = "";

			// stok_akhir
			$this->stok_akhir->ViewValue = $this->stok_akhir->CurrentValue;
			$this->stok_akhir->ViewValue = FormatNumber($this->stok_akhir->ViewValue, 2, -2, -2, -2);
			$this->stok_akhir->ViewCustomAttributes = "";

			// id_barang
			$this->id_barang->LinkCustomAttributes = "";
			$this->id_barang->HrefValue = "";
			$this->id_barang->TooltipValue = "";

			// id_klinik
			$this->id_klinik->LinkCustomAttributes = "";
			$this->id_klinik->HrefValue = "";
			$this->id_klinik->TooltipValue = "";

			// tanggal
			$this->tanggal->LinkCustomAttributes = "";
			$this->tanggal->HrefValue = "";
			$this->tanggal->TooltipValue = "";

			// id_terimabarang
			$this->id_terimabarang->LinkCustomAttributes = "";
			$this->id_terimabarang->HrefValue = "";
			$this->id_terimabarang->TooltipValue = "";

			// id_terimagudang
			$this->id_terimagudang->LinkCustomAttributes = "";
			$this->id_terimagudang->HrefValue = "";
			$this->id_terimagudang->TooltipValue = "";

			// id_penjualan
			$this->id_penjualan->LinkCustomAttributes = "";
			$this->id_penjualan->HrefValue = "";
			$this->id_penjualan->TooltipValue = "";

			// id_kirimbarang
			$this->id_kirimbarang->LinkCustomAttributes = "";
			$this->id_kirimbarang->HrefValue = "";
			$this->id_kirimbarang->TooltipValue = "";

			// id_retur
			$this->id_retur->LinkCustomAttributes = "";
			$this->id_retur->HrefValue = "";
			$this->id_retur->TooltipValue = "";

			// id_penyesuaian
			$this->id_penyesuaian->LinkCustomAttributes = "";
			$this->id_penyesuaian->HrefValue = "";
			$this->id_penyesuaian->TooltipValue = "";

			// stok_awal
			$this->stok_awal->LinkCustomAttributes = "";
			$this->stok_awal->HrefValue = "";
			$this->stok_awal->TooltipValue = "";

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

			// keluar_nonjual
			$this->keluar_nonjual->LinkCustomAttributes = "";
			$this->keluar_nonjual->HrefValue = "";
			$this->keluar_nonjual->TooltipValue = "";

			// keluar_penyesuaian
			$this->keluar_penyesuaian->LinkCustomAttributes = "";
			$this->keluar_penyesuaian->HrefValue = "";
			$this->keluar_penyesuaian->TooltipValue = "";

			// keluar_kirim
			$this->keluar_kirim->LinkCustomAttributes = "";
			$this->keluar_kirim->HrefValue = "";
			$this->keluar_kirim->TooltipValue = "";

			// retur
			$this->retur->LinkCustomAttributes = "";
			$this->retur->HrefValue = "";
			$this->retur->TooltipValue = "";

			// stok_akhir
			$this->stok_akhir->LinkCustomAttributes = "";
			$this->stok_akhir->HrefValue = "";
			$this->stok_akhir->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// id_barang
			$this->id_barang->EditAttrs["class"] = "form-control";
			$this->id_barang->EditCustomAttributes = "";
			if ($this->id_barang->getSessionValue() != "") {
				$this->id_barang->CurrentValue = $this->id_barang->getSessionValue();
				$this->id_barang->OldValue = $this->id_barang->CurrentValue;
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
			} else {
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

			// tanggal
			$this->tanggal->EditAttrs["class"] = "form-control";
			$this->tanggal->EditCustomAttributes = "";
			$this->tanggal->EditValue = HtmlEncode(FormatDateTime($this->tanggal->CurrentValue, 8));
			$this->tanggal->PlaceHolder = RemoveHtml($this->tanggal->caption());

			// id_terimabarang
			$this->id_terimabarang->EditAttrs["class"] = "form-control";
			$this->id_terimabarang->EditCustomAttributes = "";
			$this->id_terimabarang->EditValue = HtmlEncode($this->id_terimabarang->CurrentValue);
			$curVal = strval($this->id_terimabarang->CurrentValue);
			if ($curVal != "") {
				$this->id_terimabarang->EditValue = $this->id_terimabarang->lookupCacheOption($curVal);
				if ($this->id_terimabarang->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_terimabarang->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->id_terimabarang->EditValue = $this->id_terimabarang->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_terimabarang->EditValue = HtmlEncode($this->id_terimabarang->CurrentValue);
					}
				}
			} else {
				$this->id_terimabarang->EditValue = NULL;
			}
			$this->id_terimabarang->PlaceHolder = RemoveHtml($this->id_terimabarang->caption());

			// id_terimagudang
			$this->id_terimagudang->EditAttrs["class"] = "form-control";
			$this->id_terimagudang->EditCustomAttributes = "";
			$this->id_terimagudang->EditValue = HtmlEncode($this->id_terimagudang->CurrentValue);
			$curVal = strval($this->id_terimagudang->CurrentValue);
			if ($curVal != "") {
				$this->id_terimagudang->EditValue = $this->id_terimagudang->lookupCacheOption($curVal);
				if ($this->id_terimagudang->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id_terimagudang`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_terimagudang->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->id_terimagudang->EditValue = $this->id_terimagudang->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_terimagudang->EditValue = HtmlEncode($this->id_terimagudang->CurrentValue);
					}
				}
			} else {
				$this->id_terimagudang->EditValue = NULL;
			}
			$this->id_terimagudang->PlaceHolder = RemoveHtml($this->id_terimagudang->caption());

			// id_penjualan
			$this->id_penjualan->EditAttrs["class"] = "form-control";
			$this->id_penjualan->EditCustomAttributes = "";
			$this->id_penjualan->EditValue = HtmlEncode($this->id_penjualan->CurrentValue);
			$curVal = strval($this->id_penjualan->CurrentValue);
			if ($curVal != "") {
				$this->id_penjualan->EditValue = $this->id_penjualan->lookupCacheOption($curVal);
				if ($this->id_penjualan->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_penjualan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->id_penjualan->EditValue = $this->id_penjualan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_penjualan->EditValue = HtmlEncode($this->id_penjualan->CurrentValue);
					}
				}
			} else {
				$this->id_penjualan->EditValue = NULL;
			}
			$this->id_penjualan->PlaceHolder = RemoveHtml($this->id_penjualan->caption());

			// id_kirimbarang
			$this->id_kirimbarang->EditAttrs["class"] = "form-control";
			$this->id_kirimbarang->EditCustomAttributes = "";
			$this->id_kirimbarang->EditValue = HtmlEncode($this->id_kirimbarang->CurrentValue);
			$curVal = strval($this->id_kirimbarang->CurrentValue);
			if ($curVal != "") {
				$this->id_kirimbarang->EditValue = $this->id_kirimbarang->lookupCacheOption($curVal);
				if ($this->id_kirimbarang->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_kirimbarang->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->id_kirimbarang->EditValue = $this->id_kirimbarang->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_kirimbarang->EditValue = HtmlEncode($this->id_kirimbarang->CurrentValue);
					}
				}
			} else {
				$this->id_kirimbarang->EditValue = NULL;
			}
			$this->id_kirimbarang->PlaceHolder = RemoveHtml($this->id_kirimbarang->caption());

			// id_retur
			$this->id_retur->EditAttrs["class"] = "form-control";
			$this->id_retur->EditCustomAttributes = "";
			$this->id_retur->EditValue = HtmlEncode($this->id_retur->CurrentValue);
			$curVal = strval($this->id_retur->CurrentValue);
			if ($curVal != "") {
				$this->id_retur->EditValue = $this->id_retur->lookupCacheOption($curVal);
				if ($this->id_retur->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id_retur`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_retur->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->id_retur->EditValue = $this->id_retur->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_retur->EditValue = HtmlEncode($this->id_retur->CurrentValue);
					}
				}
			} else {
				$this->id_retur->EditValue = NULL;
			}
			$this->id_retur->PlaceHolder = RemoveHtml($this->id_retur->caption());

			// id_penyesuaian
			$this->id_penyesuaian->EditAttrs["class"] = "form-control";
			$this->id_penyesuaian->EditCustomAttributes = "";
			$this->id_penyesuaian->EditValue = HtmlEncode($this->id_penyesuaian->CurrentValue);
			$curVal = strval($this->id_penyesuaian->CurrentValue);
			if ($curVal != "") {
				$this->id_penyesuaian->EditValue = $this->id_penyesuaian->lookupCacheOption($curVal);
				if ($this->id_penyesuaian->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id_penyesuaianstok`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_penyesuaian->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->id_penyesuaian->EditValue = $this->id_penyesuaian->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_penyesuaian->EditValue = HtmlEncode($this->id_penyesuaian->CurrentValue);
					}
				}
			} else {
				$this->id_penyesuaian->EditValue = NULL;
			}
			$this->id_penyesuaian->PlaceHolder = RemoveHtml($this->id_penyesuaian->caption());

			// stok_awal
			$this->stok_awal->EditAttrs["class"] = "form-control";
			$this->stok_awal->EditCustomAttributes = "";
			$this->stok_awal->EditValue = HtmlEncode($this->stok_awal->CurrentValue);
			$this->stok_awal->PlaceHolder = RemoveHtml($this->stok_awal->caption());
			if (strval($this->stok_awal->EditValue) != "" && is_numeric($this->stok_awal->EditValue)) {
				$this->stok_awal->EditValue = FormatNumber($this->stok_awal->EditValue, -2, -2, -2, -2);
				$this->stok_awal->OldValue = $this->stok_awal->EditValue;
			}
			

			// masuk
			$this->masuk->EditAttrs["class"] = "form-control";
			$this->masuk->EditCustomAttributes = "";
			$this->masuk->EditValue = HtmlEncode($this->masuk->CurrentValue);
			$this->masuk->PlaceHolder = RemoveHtml($this->masuk->caption());
			if (strval($this->masuk->EditValue) != "" && is_numeric($this->masuk->EditValue)) {
				$this->masuk->EditValue = FormatNumber($this->masuk->EditValue, -2, -2, -2, -2);
				$this->masuk->OldValue = $this->masuk->EditValue;
			}
			

			// masuk_penyesuaian
			$this->masuk_penyesuaian->EditAttrs["class"] = "form-control";
			$this->masuk_penyesuaian->EditCustomAttributes = "";
			$this->masuk_penyesuaian->EditValue = HtmlEncode($this->masuk_penyesuaian->CurrentValue);
			$this->masuk_penyesuaian->PlaceHolder = RemoveHtml($this->masuk_penyesuaian->caption());
			if (strval($this->masuk_penyesuaian->EditValue) != "" && is_numeric($this->masuk_penyesuaian->EditValue)) {
				$this->masuk_penyesuaian->EditValue = FormatNumber($this->masuk_penyesuaian->EditValue, -2, -2, -2, -2);
				$this->masuk_penyesuaian->OldValue = $this->masuk_penyesuaian->EditValue;
			}
			

			// keluar
			$this->keluar->EditAttrs["class"] = "form-control";
			$this->keluar->EditCustomAttributes = "";
			$this->keluar->EditValue = HtmlEncode($this->keluar->CurrentValue);
			$this->keluar->PlaceHolder = RemoveHtml($this->keluar->caption());
			if (strval($this->keluar->EditValue) != "" && is_numeric($this->keluar->EditValue)) {
				$this->keluar->EditValue = FormatNumber($this->keluar->EditValue, -2, -2, -2, -2);
				$this->keluar->OldValue = $this->keluar->EditValue;
			}
			

			// keluar_nonjual
			$this->keluar_nonjual->EditAttrs["class"] = "form-control";
			$this->keluar_nonjual->EditCustomAttributes = "";
			$this->keluar_nonjual->EditValue = HtmlEncode($this->keluar_nonjual->CurrentValue);
			$this->keluar_nonjual->PlaceHolder = RemoveHtml($this->keluar_nonjual->caption());
			if (strval($this->keluar_nonjual->EditValue) != "" && is_numeric($this->keluar_nonjual->EditValue)) {
				$this->keluar_nonjual->EditValue = FormatNumber($this->keluar_nonjual->EditValue, -2, -2, -2, -2);
				$this->keluar_nonjual->OldValue = $this->keluar_nonjual->EditValue;
			}
			

			// keluar_penyesuaian
			$this->keluar_penyesuaian->EditAttrs["class"] = "form-control";
			$this->keluar_penyesuaian->EditCustomAttributes = "";
			$this->keluar_penyesuaian->EditValue = HtmlEncode($this->keluar_penyesuaian->CurrentValue);
			$this->keluar_penyesuaian->PlaceHolder = RemoveHtml($this->keluar_penyesuaian->caption());
			if (strval($this->keluar_penyesuaian->EditValue) != "" && is_numeric($this->keluar_penyesuaian->EditValue)) {
				$this->keluar_penyesuaian->EditValue = FormatNumber($this->keluar_penyesuaian->EditValue, -2, -2, -2, -2);
				$this->keluar_penyesuaian->OldValue = $this->keluar_penyesuaian->EditValue;
			}
			

			// keluar_kirim
			$this->keluar_kirim->EditAttrs["class"] = "form-control";
			$this->keluar_kirim->EditCustomAttributes = "";
			$this->keluar_kirim->EditValue = HtmlEncode($this->keluar_kirim->CurrentValue);
			$this->keluar_kirim->PlaceHolder = RemoveHtml($this->keluar_kirim->caption());
			if (strval($this->keluar_kirim->EditValue) != "" && is_numeric($this->keluar_kirim->EditValue)) {
				$this->keluar_kirim->EditValue = FormatNumber($this->keluar_kirim->EditValue, -2, -2, -2, -2);
				$this->keluar_kirim->OldValue = $this->keluar_kirim->EditValue;
			}
			

			// retur
			$this->retur->EditAttrs["class"] = "form-control";
			$this->retur->EditCustomAttributes = "";
			$this->retur->EditValue = HtmlEncode($this->retur->CurrentValue);
			$this->retur->PlaceHolder = RemoveHtml($this->retur->caption());
			if (strval($this->retur->EditValue) != "" && is_numeric($this->retur->EditValue)) {
				$this->retur->EditValue = FormatNumber($this->retur->EditValue, -2, -2, -2, -2);
				$this->retur->OldValue = $this->retur->EditValue;
			}
			

			// stok_akhir
			$this->stok_akhir->EditAttrs["class"] = "form-control";
			$this->stok_akhir->EditCustomAttributes = "";
			$this->stok_akhir->EditValue = HtmlEncode($this->stok_akhir->CurrentValue);
			$this->stok_akhir->PlaceHolder = RemoveHtml($this->stok_akhir->caption());
			if (strval($this->stok_akhir->EditValue) != "" && is_numeric($this->stok_akhir->EditValue)) {
				$this->stok_akhir->EditValue = FormatNumber($this->stok_akhir->EditValue, -2, -2, -2, -2);
				$this->stok_akhir->OldValue = $this->stok_akhir->EditValue;
			}
			

			// Add refer script
			// id_barang

			$this->id_barang->LinkCustomAttributes = "";
			$this->id_barang->HrefValue = "";

			// id_klinik
			$this->id_klinik->LinkCustomAttributes = "";
			$this->id_klinik->HrefValue = "";

			// tanggal
			$this->tanggal->LinkCustomAttributes = "";
			$this->tanggal->HrefValue = "";

			// id_terimabarang
			$this->id_terimabarang->LinkCustomAttributes = "";
			$this->id_terimabarang->HrefValue = "";

			// id_terimagudang
			$this->id_terimagudang->LinkCustomAttributes = "";
			$this->id_terimagudang->HrefValue = "";

			// id_penjualan
			$this->id_penjualan->LinkCustomAttributes = "";
			$this->id_penjualan->HrefValue = "";

			// id_kirimbarang
			$this->id_kirimbarang->LinkCustomAttributes = "";
			$this->id_kirimbarang->HrefValue = "";

			// id_retur
			$this->id_retur->LinkCustomAttributes = "";
			$this->id_retur->HrefValue = "";

			// id_penyesuaian
			$this->id_penyesuaian->LinkCustomAttributes = "";
			$this->id_penyesuaian->HrefValue = "";

			// stok_awal
			$this->stok_awal->LinkCustomAttributes = "";
			$this->stok_awal->HrefValue = "";

			// masuk
			$this->masuk->LinkCustomAttributes = "";
			$this->masuk->HrefValue = "";

			// masuk_penyesuaian
			$this->masuk_penyesuaian->LinkCustomAttributes = "";
			$this->masuk_penyesuaian->HrefValue = "";

			// keluar
			$this->keluar->LinkCustomAttributes = "";
			$this->keluar->HrefValue = "";

			// keluar_nonjual
			$this->keluar_nonjual->LinkCustomAttributes = "";
			$this->keluar_nonjual->HrefValue = "";

			// keluar_penyesuaian
			$this->keluar_penyesuaian->LinkCustomAttributes = "";
			$this->keluar_penyesuaian->HrefValue = "";

			// keluar_kirim
			$this->keluar_kirim->LinkCustomAttributes = "";
			$this->keluar_kirim->HrefValue = "";

			// retur
			$this->retur->LinkCustomAttributes = "";
			$this->retur->HrefValue = "";

			// stok_akhir
			$this->stok_akhir->LinkCustomAttributes = "";
			$this->stok_akhir->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// id_barang
			$this->id_barang->EditAttrs["class"] = "form-control";
			$this->id_barang->EditCustomAttributes = "";
			if ($this->id_barang->getSessionValue() != "") {
				$this->id_barang->CurrentValue = $this->id_barang->getSessionValue();
				$this->id_barang->OldValue = $this->id_barang->CurrentValue;
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
			} else {
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

			// tanggal
			$this->tanggal->EditAttrs["class"] = "form-control";
			$this->tanggal->EditCustomAttributes = "";
			$this->tanggal->EditValue = HtmlEncode(FormatDateTime($this->tanggal->CurrentValue, 8));
			$this->tanggal->PlaceHolder = RemoveHtml($this->tanggal->caption());

			// id_terimabarang
			$this->id_terimabarang->EditAttrs["class"] = "form-control";
			$this->id_terimabarang->EditCustomAttributes = "";
			$this->id_terimabarang->EditValue = HtmlEncode($this->id_terimabarang->CurrentValue);
			$curVal = strval($this->id_terimabarang->CurrentValue);
			if ($curVal != "") {
				$this->id_terimabarang->EditValue = $this->id_terimabarang->lookupCacheOption($curVal);
				if ($this->id_terimabarang->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_terimabarang->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->id_terimabarang->EditValue = $this->id_terimabarang->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_terimabarang->EditValue = HtmlEncode($this->id_terimabarang->CurrentValue);
					}
				}
			} else {
				$this->id_terimabarang->EditValue = NULL;
			}
			$this->id_terimabarang->PlaceHolder = RemoveHtml($this->id_terimabarang->caption());

			// id_terimagudang
			$this->id_terimagudang->EditAttrs["class"] = "form-control";
			$this->id_terimagudang->EditCustomAttributes = "";
			$this->id_terimagudang->EditValue = HtmlEncode($this->id_terimagudang->CurrentValue);
			$curVal = strval($this->id_terimagudang->CurrentValue);
			if ($curVal != "") {
				$this->id_terimagudang->EditValue = $this->id_terimagudang->lookupCacheOption($curVal);
				if ($this->id_terimagudang->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id_terimagudang`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_terimagudang->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->id_terimagudang->EditValue = $this->id_terimagudang->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_terimagudang->EditValue = HtmlEncode($this->id_terimagudang->CurrentValue);
					}
				}
			} else {
				$this->id_terimagudang->EditValue = NULL;
			}
			$this->id_terimagudang->PlaceHolder = RemoveHtml($this->id_terimagudang->caption());

			// id_penjualan
			$this->id_penjualan->EditAttrs["class"] = "form-control";
			$this->id_penjualan->EditCustomAttributes = "";
			$this->id_penjualan->EditValue = HtmlEncode($this->id_penjualan->CurrentValue);
			$curVal = strval($this->id_penjualan->CurrentValue);
			if ($curVal != "") {
				$this->id_penjualan->EditValue = $this->id_penjualan->lookupCacheOption($curVal);
				if ($this->id_penjualan->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_penjualan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->id_penjualan->EditValue = $this->id_penjualan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_penjualan->EditValue = HtmlEncode($this->id_penjualan->CurrentValue);
					}
				}
			} else {
				$this->id_penjualan->EditValue = NULL;
			}
			$this->id_penjualan->PlaceHolder = RemoveHtml($this->id_penjualan->caption());

			// id_kirimbarang
			$this->id_kirimbarang->EditAttrs["class"] = "form-control";
			$this->id_kirimbarang->EditCustomAttributes = "";
			$this->id_kirimbarang->EditValue = HtmlEncode($this->id_kirimbarang->CurrentValue);
			$curVal = strval($this->id_kirimbarang->CurrentValue);
			if ($curVal != "") {
				$this->id_kirimbarang->EditValue = $this->id_kirimbarang->lookupCacheOption($curVal);
				if ($this->id_kirimbarang->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_kirimbarang->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->id_kirimbarang->EditValue = $this->id_kirimbarang->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_kirimbarang->EditValue = HtmlEncode($this->id_kirimbarang->CurrentValue);
					}
				}
			} else {
				$this->id_kirimbarang->EditValue = NULL;
			}
			$this->id_kirimbarang->PlaceHolder = RemoveHtml($this->id_kirimbarang->caption());

			// id_retur
			$this->id_retur->EditAttrs["class"] = "form-control";
			$this->id_retur->EditCustomAttributes = "";
			$this->id_retur->EditValue = HtmlEncode($this->id_retur->CurrentValue);
			$curVal = strval($this->id_retur->CurrentValue);
			if ($curVal != "") {
				$this->id_retur->EditValue = $this->id_retur->lookupCacheOption($curVal);
				if ($this->id_retur->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id_retur`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_retur->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->id_retur->EditValue = $this->id_retur->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_retur->EditValue = HtmlEncode($this->id_retur->CurrentValue);
					}
				}
			} else {
				$this->id_retur->EditValue = NULL;
			}
			$this->id_retur->PlaceHolder = RemoveHtml($this->id_retur->caption());

			// id_penyesuaian
			$this->id_penyesuaian->EditAttrs["class"] = "form-control";
			$this->id_penyesuaian->EditCustomAttributes = "";
			$this->id_penyesuaian->EditValue = HtmlEncode($this->id_penyesuaian->CurrentValue);
			$curVal = strval($this->id_penyesuaian->CurrentValue);
			if ($curVal != "") {
				$this->id_penyesuaian->EditValue = $this->id_penyesuaian->lookupCacheOption($curVal);
				if ($this->id_penyesuaian->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id_penyesuaianstok`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_penyesuaian->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->id_penyesuaian->EditValue = $this->id_penyesuaian->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_penyesuaian->EditValue = HtmlEncode($this->id_penyesuaian->CurrentValue);
					}
				}
			} else {
				$this->id_penyesuaian->EditValue = NULL;
			}
			$this->id_penyesuaian->PlaceHolder = RemoveHtml($this->id_penyesuaian->caption());

			// stok_awal
			$this->stok_awal->EditAttrs["class"] = "form-control";
			$this->stok_awal->EditCustomAttributes = "";
			$this->stok_awal->EditValue = HtmlEncode($this->stok_awal->CurrentValue);
			$this->stok_awal->PlaceHolder = RemoveHtml($this->stok_awal->caption());
			if (strval($this->stok_awal->EditValue) != "" && is_numeric($this->stok_awal->EditValue)) {
				$this->stok_awal->EditValue = FormatNumber($this->stok_awal->EditValue, -2, -2, -2, -2);
				$this->stok_awal->OldValue = $this->stok_awal->EditValue;
			}
			

			// masuk
			$this->masuk->EditAttrs["class"] = "form-control";
			$this->masuk->EditCustomAttributes = "";
			$this->masuk->EditValue = HtmlEncode($this->masuk->CurrentValue);
			$this->masuk->PlaceHolder = RemoveHtml($this->masuk->caption());
			if (strval($this->masuk->EditValue) != "" && is_numeric($this->masuk->EditValue)) {
				$this->masuk->EditValue = FormatNumber($this->masuk->EditValue, -2, -2, -2, -2);
				$this->masuk->OldValue = $this->masuk->EditValue;
			}
			

			// masuk_penyesuaian
			$this->masuk_penyesuaian->EditAttrs["class"] = "form-control";
			$this->masuk_penyesuaian->EditCustomAttributes = "";
			$this->masuk_penyesuaian->EditValue = HtmlEncode($this->masuk_penyesuaian->CurrentValue);
			$this->masuk_penyesuaian->PlaceHolder = RemoveHtml($this->masuk_penyesuaian->caption());
			if (strval($this->masuk_penyesuaian->EditValue) != "" && is_numeric($this->masuk_penyesuaian->EditValue)) {
				$this->masuk_penyesuaian->EditValue = FormatNumber($this->masuk_penyesuaian->EditValue, -2, -2, -2, -2);
				$this->masuk_penyesuaian->OldValue = $this->masuk_penyesuaian->EditValue;
			}
			

			// keluar
			$this->keluar->EditAttrs["class"] = "form-control";
			$this->keluar->EditCustomAttributes = "";
			$this->keluar->EditValue = HtmlEncode($this->keluar->CurrentValue);
			$this->keluar->PlaceHolder = RemoveHtml($this->keluar->caption());
			if (strval($this->keluar->EditValue) != "" && is_numeric($this->keluar->EditValue)) {
				$this->keluar->EditValue = FormatNumber($this->keluar->EditValue, -2, -2, -2, -2);
				$this->keluar->OldValue = $this->keluar->EditValue;
			}
			

			// keluar_nonjual
			$this->keluar_nonjual->EditAttrs["class"] = "form-control";
			$this->keluar_nonjual->EditCustomAttributes = "";
			$this->keluar_nonjual->EditValue = HtmlEncode($this->keluar_nonjual->CurrentValue);
			$this->keluar_nonjual->PlaceHolder = RemoveHtml($this->keluar_nonjual->caption());
			if (strval($this->keluar_nonjual->EditValue) != "" && is_numeric($this->keluar_nonjual->EditValue)) {
				$this->keluar_nonjual->EditValue = FormatNumber($this->keluar_nonjual->EditValue, -2, -2, -2, -2);
				$this->keluar_nonjual->OldValue = $this->keluar_nonjual->EditValue;
			}
			

			// keluar_penyesuaian
			$this->keluar_penyesuaian->EditAttrs["class"] = "form-control";
			$this->keluar_penyesuaian->EditCustomAttributes = "";
			$this->keluar_penyesuaian->EditValue = HtmlEncode($this->keluar_penyesuaian->CurrentValue);
			$this->keluar_penyesuaian->PlaceHolder = RemoveHtml($this->keluar_penyesuaian->caption());
			if (strval($this->keluar_penyesuaian->EditValue) != "" && is_numeric($this->keluar_penyesuaian->EditValue)) {
				$this->keluar_penyesuaian->EditValue = FormatNumber($this->keluar_penyesuaian->EditValue, -2, -2, -2, -2);
				$this->keluar_penyesuaian->OldValue = $this->keluar_penyesuaian->EditValue;
			}
			

			// keluar_kirim
			$this->keluar_kirim->EditAttrs["class"] = "form-control";
			$this->keluar_kirim->EditCustomAttributes = "";
			$this->keluar_kirim->EditValue = HtmlEncode($this->keluar_kirim->CurrentValue);
			$this->keluar_kirim->PlaceHolder = RemoveHtml($this->keluar_kirim->caption());
			if (strval($this->keluar_kirim->EditValue) != "" && is_numeric($this->keluar_kirim->EditValue)) {
				$this->keluar_kirim->EditValue = FormatNumber($this->keluar_kirim->EditValue, -2, -2, -2, -2);
				$this->keluar_kirim->OldValue = $this->keluar_kirim->EditValue;
			}
			

			// retur
			$this->retur->EditAttrs["class"] = "form-control";
			$this->retur->EditCustomAttributes = "";
			$this->retur->EditValue = HtmlEncode($this->retur->CurrentValue);
			$this->retur->PlaceHolder = RemoveHtml($this->retur->caption());
			if (strval($this->retur->EditValue) != "" && is_numeric($this->retur->EditValue)) {
				$this->retur->EditValue = FormatNumber($this->retur->EditValue, -2, -2, -2, -2);
				$this->retur->OldValue = $this->retur->EditValue;
			}
			

			// stok_akhir
			$this->stok_akhir->EditAttrs["class"] = "form-control";
			$this->stok_akhir->EditCustomAttributes = "";
			$this->stok_akhir->EditValue = HtmlEncode($this->stok_akhir->CurrentValue);
			$this->stok_akhir->PlaceHolder = RemoveHtml($this->stok_akhir->caption());
			if (strval($this->stok_akhir->EditValue) != "" && is_numeric($this->stok_akhir->EditValue)) {
				$this->stok_akhir->EditValue = FormatNumber($this->stok_akhir->EditValue, -2, -2, -2, -2);
				$this->stok_akhir->OldValue = $this->stok_akhir->EditValue;
			}
			

			// Edit refer script
			// id_barang

			$this->id_barang->LinkCustomAttributes = "";
			$this->id_barang->HrefValue = "";

			// id_klinik
			$this->id_klinik->LinkCustomAttributes = "";
			$this->id_klinik->HrefValue = "";

			// tanggal
			$this->tanggal->LinkCustomAttributes = "";
			$this->tanggal->HrefValue = "";

			// id_terimabarang
			$this->id_terimabarang->LinkCustomAttributes = "";
			$this->id_terimabarang->HrefValue = "";

			// id_terimagudang
			$this->id_terimagudang->LinkCustomAttributes = "";
			$this->id_terimagudang->HrefValue = "";

			// id_penjualan
			$this->id_penjualan->LinkCustomAttributes = "";
			$this->id_penjualan->HrefValue = "";

			// id_kirimbarang
			$this->id_kirimbarang->LinkCustomAttributes = "";
			$this->id_kirimbarang->HrefValue = "";

			// id_retur
			$this->id_retur->LinkCustomAttributes = "";
			$this->id_retur->HrefValue = "";

			// id_penyesuaian
			$this->id_penyesuaian->LinkCustomAttributes = "";
			$this->id_penyesuaian->HrefValue = "";

			// stok_awal
			$this->stok_awal->LinkCustomAttributes = "";
			$this->stok_awal->HrefValue = "";

			// masuk
			$this->masuk->LinkCustomAttributes = "";
			$this->masuk->HrefValue = "";

			// masuk_penyesuaian
			$this->masuk_penyesuaian->LinkCustomAttributes = "";
			$this->masuk_penyesuaian->HrefValue = "";

			// keluar
			$this->keluar->LinkCustomAttributes = "";
			$this->keluar->HrefValue = "";

			// keluar_nonjual
			$this->keluar_nonjual->LinkCustomAttributes = "";
			$this->keluar_nonjual->HrefValue = "";

			// keluar_penyesuaian
			$this->keluar_penyesuaian->LinkCustomAttributes = "";
			$this->keluar_penyesuaian->HrefValue = "";

			// keluar_kirim
			$this->keluar_kirim->LinkCustomAttributes = "";
			$this->keluar_kirim->HrefValue = "";

			// retur
			$this->retur->LinkCustomAttributes = "";
			$this->retur->HrefValue = "";

			// stok_akhir
			$this->stok_akhir->LinkCustomAttributes = "";
			$this->stok_akhir->HrefValue = "";
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
		if ($this->id_barang->Required) {
			if (!$this->id_barang->IsDetailKey && $this->id_barang->FormValue != NULL && $this->id_barang->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_barang->caption(), $this->id_barang->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->id_barang->FormValue)) {
			AddMessage($FormError, $this->id_barang->errorMessage());
		}
		if ($this->id_klinik->Required) {
			if (!$this->id_klinik->IsDetailKey && $this->id_klinik->FormValue != NULL && $this->id_klinik->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_klinik->caption(), $this->id_klinik->RequiredErrorMessage));
			}
		}
		if ($this->tanggal->Required) {
			if (!$this->tanggal->IsDetailKey && $this->tanggal->FormValue != NULL && $this->tanggal->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tanggal->caption(), $this->tanggal->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tanggal->FormValue)) {
			AddMessage($FormError, $this->tanggal->errorMessage());
		}
		if ($this->id_terimabarang->Required) {
			if (!$this->id_terimabarang->IsDetailKey && $this->id_terimabarang->FormValue != NULL && $this->id_terimabarang->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_terimabarang->caption(), $this->id_terimabarang->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->id_terimabarang->FormValue)) {
			AddMessage($FormError, $this->id_terimabarang->errorMessage());
		}
		if ($this->id_terimagudang->Required) {
			if (!$this->id_terimagudang->IsDetailKey && $this->id_terimagudang->FormValue != NULL && $this->id_terimagudang->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_terimagudang->caption(), $this->id_terimagudang->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->id_terimagudang->FormValue)) {
			AddMessage($FormError, $this->id_terimagudang->errorMessage());
		}
		if ($this->id_penjualan->Required) {
			if (!$this->id_penjualan->IsDetailKey && $this->id_penjualan->FormValue != NULL && $this->id_penjualan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_penjualan->caption(), $this->id_penjualan->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->id_penjualan->FormValue)) {
			AddMessage($FormError, $this->id_penjualan->errorMessage());
		}
		if ($this->id_kirimbarang->Required) {
			if (!$this->id_kirimbarang->IsDetailKey && $this->id_kirimbarang->FormValue != NULL && $this->id_kirimbarang->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_kirimbarang->caption(), $this->id_kirimbarang->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->id_kirimbarang->FormValue)) {
			AddMessage($FormError, $this->id_kirimbarang->errorMessage());
		}
		if ($this->id_retur->Required) {
			if (!$this->id_retur->IsDetailKey && $this->id_retur->FormValue != NULL && $this->id_retur->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_retur->caption(), $this->id_retur->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->id_retur->FormValue)) {
			AddMessage($FormError, $this->id_retur->errorMessage());
		}
		if ($this->id_penyesuaian->Required) {
			if (!$this->id_penyesuaian->IsDetailKey && $this->id_penyesuaian->FormValue != NULL && $this->id_penyesuaian->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_penyesuaian->caption(), $this->id_penyesuaian->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->id_penyesuaian->FormValue)) {
			AddMessage($FormError, $this->id_penyesuaian->errorMessage());
		}
		if ($this->stok_awal->Required) {
			if (!$this->stok_awal->IsDetailKey && $this->stok_awal->FormValue != NULL && $this->stok_awal->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->stok_awal->caption(), $this->stok_awal->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->stok_awal->FormValue)) {
			AddMessage($FormError, $this->stok_awal->errorMessage());
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
		if ($this->keluar_nonjual->Required) {
			if (!$this->keluar_nonjual->IsDetailKey && $this->keluar_nonjual->FormValue != NULL && $this->keluar_nonjual->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->keluar_nonjual->caption(), $this->keluar_nonjual->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->keluar_nonjual->FormValue)) {
			AddMessage($FormError, $this->keluar_nonjual->errorMessage());
		}
		if ($this->keluar_penyesuaian->Required) {
			if (!$this->keluar_penyesuaian->IsDetailKey && $this->keluar_penyesuaian->FormValue != NULL && $this->keluar_penyesuaian->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->keluar_penyesuaian->caption(), $this->keluar_penyesuaian->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->keluar_penyesuaian->FormValue)) {
			AddMessage($FormError, $this->keluar_penyesuaian->errorMessage());
		}
		if ($this->keluar_kirim->Required) {
			if (!$this->keluar_kirim->IsDetailKey && $this->keluar_kirim->FormValue != NULL && $this->keluar_kirim->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->keluar_kirim->caption(), $this->keluar_kirim->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->keluar_kirim->FormValue)) {
			AddMessage($FormError, $this->keluar_kirim->errorMessage());
		}
		if ($this->retur->Required) {
			if (!$this->retur->IsDetailKey && $this->retur->FormValue != NULL && $this->retur->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->retur->caption(), $this->retur->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->retur->FormValue)) {
			AddMessage($FormError, $this->retur->errorMessage());
		}
		if ($this->stok_akhir->Required) {
			if (!$this->stok_akhir->IsDetailKey && $this->stok_akhir->FormValue != NULL && $this->stok_akhir->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->stok_akhir->caption(), $this->stok_akhir->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->stok_akhir->FormValue)) {
			AddMessage($FormError, $this->stok_akhir->errorMessage());
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
				$thisKey .= $row['id_kartustok'];
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

			// id_barang
			$this->id_barang->setDbValueDef($rsnew, $this->id_barang->CurrentValue, NULL, $this->id_barang->ReadOnly);

			// id_klinik
			$this->id_klinik->setDbValueDef($rsnew, $this->id_klinik->CurrentValue, NULL, $this->id_klinik->ReadOnly);

			// tanggal
			$this->tanggal->setDbValueDef($rsnew, UnFormatDateTime($this->tanggal->CurrentValue, 0), NULL, $this->tanggal->ReadOnly);

			// id_terimabarang
			$this->id_terimabarang->setDbValueDef($rsnew, $this->id_terimabarang->CurrentValue, NULL, $this->id_terimabarang->ReadOnly);

			// id_terimagudang
			$this->id_terimagudang->setDbValueDef($rsnew, $this->id_terimagudang->CurrentValue, NULL, $this->id_terimagudang->ReadOnly);

			// id_penjualan
			$this->id_penjualan->setDbValueDef($rsnew, $this->id_penjualan->CurrentValue, NULL, $this->id_penjualan->ReadOnly);

			// id_kirimbarang
			$this->id_kirimbarang->setDbValueDef($rsnew, $this->id_kirimbarang->CurrentValue, NULL, $this->id_kirimbarang->ReadOnly);

			// id_retur
			$this->id_retur->setDbValueDef($rsnew, $this->id_retur->CurrentValue, NULL, $this->id_retur->ReadOnly);

			// id_penyesuaian
			$this->id_penyesuaian->setDbValueDef($rsnew, $this->id_penyesuaian->CurrentValue, NULL, $this->id_penyesuaian->ReadOnly);

			// stok_awal
			$this->stok_awal->setDbValueDef($rsnew, $this->stok_awal->CurrentValue, NULL, $this->stok_awal->ReadOnly);

			// masuk
			$this->masuk->setDbValueDef($rsnew, $this->masuk->CurrentValue, NULL, $this->masuk->ReadOnly);

			// masuk_penyesuaian
			$this->masuk_penyesuaian->setDbValueDef($rsnew, $this->masuk_penyesuaian->CurrentValue, NULL, $this->masuk_penyesuaian->ReadOnly);

			// keluar
			$this->keluar->setDbValueDef($rsnew, $this->keluar->CurrentValue, NULL, $this->keluar->ReadOnly);

			// keluar_nonjual
			$this->keluar_nonjual->setDbValueDef($rsnew, $this->keluar_nonjual->CurrentValue, NULL, $this->keluar_nonjual->ReadOnly);

			// keluar_penyesuaian
			$this->keluar_penyesuaian->setDbValueDef($rsnew, $this->keluar_penyesuaian->CurrentValue, NULL, $this->keluar_penyesuaian->ReadOnly);

			// keluar_kirim
			$this->keluar_kirim->setDbValueDef($rsnew, $this->keluar_kirim->CurrentValue, NULL, $this->keluar_kirim->ReadOnly);

			// retur
			$this->retur->setDbValueDef($rsnew, $this->retur->CurrentValue, NULL, $this->retur->ReadOnly);

			// stok_akhir
			$this->stok_akhir->setDbValueDef($rsnew, $this->stok_akhir->CurrentValue, NULL, $this->stok_akhir->ReadOnly);

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
			if ($this->getCurrentMasterTable() == "V_kartustok") {
				$this->id_barang->CurrentValue = $this->id_barang->getSessionValue();
			}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// id_barang
		$this->id_barang->setDbValueDef($rsnew, $this->id_barang->CurrentValue, NULL, FALSE);

		// id_klinik
		$this->id_klinik->setDbValueDef($rsnew, $this->id_klinik->CurrentValue, NULL, FALSE);

		// tanggal
		$this->tanggal->setDbValueDef($rsnew, UnFormatDateTime($this->tanggal->CurrentValue, 0), NULL, FALSE);

		// id_terimabarang
		$this->id_terimabarang->setDbValueDef($rsnew, $this->id_terimabarang->CurrentValue, NULL, FALSE);

		// id_terimagudang
		$this->id_terimagudang->setDbValueDef($rsnew, $this->id_terimagudang->CurrentValue, NULL, FALSE);

		// id_penjualan
		$this->id_penjualan->setDbValueDef($rsnew, $this->id_penjualan->CurrentValue, NULL, FALSE);

		// id_kirimbarang
		$this->id_kirimbarang->setDbValueDef($rsnew, $this->id_kirimbarang->CurrentValue, NULL, FALSE);

		// id_retur
		$this->id_retur->setDbValueDef($rsnew, $this->id_retur->CurrentValue, NULL, FALSE);

		// id_penyesuaian
		$this->id_penyesuaian->setDbValueDef($rsnew, $this->id_penyesuaian->CurrentValue, NULL, FALSE);

		// stok_awal
		$this->stok_awal->setDbValueDef($rsnew, $this->stok_awal->CurrentValue, NULL, FALSE);

		// masuk
		$this->masuk->setDbValueDef($rsnew, $this->masuk->CurrentValue, NULL, FALSE);

		// masuk_penyesuaian
		$this->masuk_penyesuaian->setDbValueDef($rsnew, $this->masuk_penyesuaian->CurrentValue, NULL, FALSE);

		// keluar
		$this->keluar->setDbValueDef($rsnew, $this->keluar->CurrentValue, NULL, FALSE);

		// keluar_nonjual
		$this->keluar_nonjual->setDbValueDef($rsnew, $this->keluar_nonjual->CurrentValue, NULL, FALSE);

		// keluar_penyesuaian
		$this->keluar_penyesuaian->setDbValueDef($rsnew, $this->keluar_penyesuaian->CurrentValue, NULL, FALSE);

		// keluar_kirim
		$this->keluar_kirim->setDbValueDef($rsnew, $this->keluar_kirim->CurrentValue, NULL, FALSE);

		// retur
		$this->retur->setDbValueDef($rsnew, $this->retur->CurrentValue, NULL, FALSE);

		// stok_akhir
		$this->stok_akhir->setDbValueDef($rsnew, $this->stok_akhir->CurrentValue, NULL, FALSE);

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
		if ($masterTblVar == "V_kartustok") {
			$this->id_barang->Visible = FALSE;
			if ($GLOBALS["V_kartustok"]->EventCancelled)
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
				case "x_id_barang":
					break;
				case "x_id_klinik":
					break;
				case "x_id_terimabarang":
					break;
				case "x_id_terimagudang":
					break;
				case "x_id_penjualan":
					break;
				case "x_id_kirimbarang":
					break;
				case "x_id_nonjual":
					break;
				case "x_id_retur":
					break;
				case "x_id_penyesuaian":
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
						case "x_id_terimabarang":
							break;
						case "x_id_terimagudang":
							break;
						case "x_id_penjualan":
							break;
						case "x_id_kirimbarang":
							break;
						case "x_id_nonjual":
							break;
						case "x_id_retur":
							break;
						case "x_id_penyesuaian":
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
		Language()->setPhrase("EnterSearchCriteria", "Cari data sesuai kriteria yang diinginkan...");
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
		//$this->OtherOptions["addedit"]->UseDropDownButton = FALSE; // jangan gunakan style DropDownButton
		//$my_options = &$this->OtherOptions; // pastikan menggunakan area OtherOptions
		//$my_option = $my_options["addedit"]; // dekat tombol addedit
		//$my_item = &$my_option->Add("mynewbutton"); // tambahkan tombol baru
		//$my_item->Body =
		//	"<a class=\"ml-3\" style=\" font-size: 15px; font-weight: bold; background-color: #27AE60; border-radius: 1; color: white; \"
		//	title=\"Laporan\" data-caption=\"Laporan\" href=\"kartu.php\">Laporan Kartu Stok</a>";

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