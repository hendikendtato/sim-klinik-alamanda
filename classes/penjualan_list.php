<?php
namespace PHPMaker2020\sim_klinik_alamanda;

/**
 * Page class
 */
class penjualan_list extends penjualan
{

	// Page ID
	public $PageID = "list";

	// Project ID
	public $ProjectID = "{8546B030-7993-4749-BFDB-17AFAAF4065D}";

	// Table name
	public $TableName = 'penjualan';

	// Page object name
	public $PageObjName = "penjualan_list";

	// Grid form hidden field names
	public $FormName = "fpenjualanlist";
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

	// Export URLs
	public $ExportPrintUrl;
	public $ExportHtmlUrl;
	public $ExportExcelUrl;
	public $ExportWordUrl;
	public $ExportXmlUrl;
	public $ExportCsvUrl;
	public $ExportPdfUrl;

	// Custom export
	public $ExportExcelCustom = FALSE;
	public $ExportWordCustom = FALSE;
	public $ExportPdfCustom = FALSE;
	public $ExportEmailCustom = FALSE;

	// Update URLs
	public $InlineAddUrl;
	public $InlineCopyUrl;
	public $InlineEditUrl;
	public $GridAddUrl;
	public $GridEditUrl;
	public $MultiDeleteUrl;
	public $MultiUpdateUrl;

	// Audit Trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

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

		// Table object (penjualan)
		if (!isset($GLOBALS["penjualan"]) || get_class($GLOBALS["penjualan"]) == PROJECT_NAMESPACE . "penjualan") {
			$GLOBALS["penjualan"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["penjualan"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html";
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv";
		$this->AddUrl = "penjualanadd.php?" . Config("TABLE_SHOW_DETAIL") . "=";
		$this->InlineAddUrl = $this->pageUrl() . "action=add";
		$this->GridAddUrl = $this->pageUrl() . "action=gridadd";
		$this->GridEditUrl = $this->pageUrl() . "action=gridedit";
		$this->MultiDeleteUrl = "penjualandelete.php";
		$this->MultiUpdateUrl = "penjualanupdate.php";

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'list');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'penjualan');

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

		// Export options
		$this->ExportOptions = new ListOptions("div");
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Import options
		$this->ImportOptions = new ListOptions("div");
		$this->ImportOptions->TagClassName = "ew-import-option";

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["addedit"] = new ListOptions("div");
		$this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
		$this->OtherOptions["detail"] = new ListOptions("div");
		$this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
		$this->OtherOptions["action"] = new ListOptions("div");
		$this->OtherOptions["action"]->TagClassName = "ew-action-option";

		// Filter options
		$this->FilterOptions = new ListOptions("div");
		$this->FilterOptions->TagClassName = "ew-filter-option fpenjualanlistsrch";

		// List actions
		$this->ListActions = new ListActions();
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
		global $penjualan;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($penjualan);
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
						if ($fld->DataType == DATATYPE_MEMO && $fld->MemoMaxLength > 0)
							$val = TruncateMemo($val, $fld->MemoMaxLength, $fld->TruncateMemoRemoveHtml);
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
	public $detailpenjualan_Count;
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
			if (!$Security->canList()) {
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
			if (!$Security->canList()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				$this->terminate(GetUrl("index.php"));
				return;
			}
		}

		// Get export parameters
		$custom = "";
		if (Param("export") !== NULL) {
			$this->Export = Param("export");
			$custom = Param("custom", "");
		} elseif (IsPost()) {
			if (Post("exporttype") !== NULL)
				$this->Export = Post("exporttype");
			$custom = Post("custom", "");
		} elseif (Get("cmd") == "json") {
			$this->Export = Get("cmd");
		} else {
			$this->setExportReturnUrl(CurrentUrl());
		}
		$ExportFileName = $this->TableVar; // Get export file, used in header

		// Get custom export parameters
		if ($this->isExport() && $custom != "") {
			$this->CustomExport = $this->Export;
			$this->Export = "print";
		}
		$CustomExportType = $this->CustomExport;
		$ExportType = $this->Export; // Get export parameter, used in header

		// Update Export URLs
		if (Config("USE_PHPEXCEL"))
			$this->ExportExcelCustom = FALSE;
		if ($this->ExportExcelCustom)
			$this->ExportExcelUrl .= "&amp;custom=1";
		if (Config("USE_PHPWORD"))
			$this->ExportWordCustom = FALSE;
		if ($this->ExportWordCustom)
			$this->ExportWordUrl .= "&amp;custom=1";
		if ($this->ExportPdfCustom)
			$this->ExportPdfUrl .= "&amp;custom=1";
		$this->CurrentAction = Param("action"); // Set up current action

		// Get grid add count
		$gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->setupListOptions();

		// Setup export options
		$this->setupExportOptions();
		$this->id->Visible = FALSE;
		$this->kode_penjualan->setVisibility();
		$this->id_pelanggan->setVisibility();
		$this->id_member->Visible = FALSE;
		$this->waktu->setVisibility();
		$this->diskon_persen->Visible = FALSE;
		$this->diskon_rupiah->Visible = FALSE;
		$this->ppn->Visible = FALSE;
		$this->total->setVisibility();
		$this->bayar->setVisibility();
		$this->bayar_non_tunai->Visible = FALSE;
		$this->total_non_tunai_charge->setVisibility();
		$this->keterangan->Visible = FALSE;
		$this->id_klinik->Visible = FALSE;
		$this->id_rmd->Visible = FALSE;
		$this->metode_pembayaran->setVisibility();
		$this->id_bank->Visible = FALSE;
		$this->id_kartu->Visible = FALSE;
		$this->sales->Visible = FALSE;
		$this->dok_be_wajah->Visible = FALSE;
		$this->be_body->Visible = FALSE;
		$this->medis->Visible = FALSE;
		$this->dokter->Visible = FALSE;
		$this->id_kartubank->setVisibility();
		$this->id_kas->setVisibility();
		$this->charge->setVisibility();
		$this->klaim_poin->setVisibility();
		$this->total_penukaran_poin->setVisibility();
		$this->ongkir->Visible = FALSE;
		$this->_action->Visible = FALSE;
		$this->status->setVisibility();
		$this->status_void->Visible = FALSE;
		$this->jumlah_voucher->Visible = FALSE;
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

		// Setup other options
		$this->setupOtherOptions();

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions["checkbox"]->Visible = TRUE;
				break;
			}
		}

		// Set up lookup cache
		$this->setupLookupOptions($this->id_pelanggan);
		$this->setupLookupOptions($this->id_member);
		$this->setupLookupOptions($this->id_klinik);
		$this->setupLookupOptions($this->id_rmd);
		$this->setupLookupOptions($this->id_bank);
		$this->setupLookupOptions($this->id_kartu);
		$this->setupLookupOptions($this->sales);
		$this->setupLookupOptions($this->dok_be_wajah);
		$this->setupLookupOptions($this->be_body);
		$this->setupLookupOptions($this->medis);
		$this->setupLookupOptions($this->dokter);
		$this->setupLookupOptions($this->id_kartubank);
		$this->setupLookupOptions($this->id_kas);

		// Search filters
		$srchAdvanced = ""; // Advanced search filter
		$srchBasic = ""; // Basic search filter
		$filter = "";

		// Get command
		$this->Command = strtolower(Get("cmd"));
		if ($this->isPageRequest()) { // Validate request

			// Process list action first
			if ($this->processListAction()) // Ajax request
				$this->terminate();

			// Set up records per page
			$this->setupDisplayRecords();

			// Handle reset command
			$this->resetCmd();

			// Set up Breadcrumb
			if (!$this->isExport())
				$this->setupBreadcrumb();

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

			// Hide options
			if ($this->isExport() || $this->CurrentAction) {
				$this->ExportOptions->hideAllOptions();
				$this->FilterOptions->hideAllOptions();
				$this->ImportOptions->hideAllOptions();
			}

			// Hide other options
			if ($this->isExport())
				$this->OtherOptions->hideAllOptions();

			// Get default search criteria
			AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(TRUE));
			AddFilter($this->DefaultSearchWhere, $this->advancedSearchWhere(TRUE));

			// Get basic search values
			$this->loadBasicSearchValues();

			// Get and validate search values for advanced search
			$this->loadSearchValues(); // Get search values

			// Process filter list
			if ($this->processFilterList())
				$this->terminate();
			if (!$this->validateSearch())
				$this->setFailureMessage($SearchError);

			// Restore search parms from Session if not searching / reset / export
			if (($this->isExport() || $this->Command != "search" && $this->Command != "reset" && $this->Command != "resetall") && $this->Command != "json" && $this->checkSearchParms())
				$this->restoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->setupSortOrder();

			// Get basic search criteria
			if ($SearchError == "")
				$srchBasic = $this->basicSearchWhere();

			// Get search criteria for advanced search
			if ($SearchError == "")
				$srchAdvanced = $this->advancedSearchWhere();
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

		// Load search default if no existing search criteria
		if (!$this->checkSearchParms()) {

			// Load basic search from default
			$this->BasicSearch->loadDefault();
			if ($this->BasicSearch->Keyword != "")
				$srchBasic = $this->basicSearchWhere();

			// Load advanced search from default
			if ($this->loadAdvancedSearchDefault()) {
				$srchAdvanced = $this->advancedSearchWhere();
			}
		}

		// Restore search settings from Session
		if ($SearchError == "")
			$this->loadAdvancedSearch();

		// Build search criteria
		AddFilter($this->SearchWhere, $srchAdvanced);
		AddFilter($this->SearchWhere, $srchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->Command != "json") {
			$this->SearchWhere = $this->getSearchWhere();
		}

		// Build filter
		$filter = "";
		if (!$Security->canList())
			$filter = "(0=1)"; // Filter all records
		AddFilter($filter, $this->DbDetailFilter);
		AddFilter($filter, $this->SearchWhere);

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSql = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $filter;
		} else {
			$this->setSessionWhere($filter);
			$this->CurrentFilter = "";
		}

		// Export data only
		if (!$this->CustomExport && in_array($this->Export, array_keys(Config("EXPORT_CLASSES")))) {
			$this->exportData();
			$this->terminate();
		}
		if ($this->isGridAdd()) {
			$this->CurrentFilter = "0=1";
			$this->StartRecord = 1;
			$this->DisplayRecords = $this->GridAddRowCount;
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
			if ($this->DisplayRecords <= 0 || ($this->isExport() && $this->ExportAll)) // Display all records
				$this->DisplayRecords = $this->TotalRecords;
			if (!($this->isExport() && $this->ExportAll)) // Set up start record position
				$this->setupStartRecord();
			if ($selectLimit)
				$this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);

			// Set no record found message
			if (!$this->CurrentAction && $this->TotalRecords == 0) {
				if (!$Security->canList())
					$this->setWarningMessage(DeniedMessage());
				if ($this->SearchWhere == "0=101")
					$this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
				else
					$this->setWarningMessage($Language->phrase("NoRecord"));
			}

			// Audit trail on search
			if ($this->AuditTrailOnSearch && $this->Command == "search" && !$this->RestoreSearch) {
				$searchParm = ServerVar("QUERY_STRING");
				$searchSql = $this->getSessionWhere();
				$this->writeAuditTrailOnSearch($searchParm, $searchSql);
			}
		}

		// Search options
		$this->setupSearchOptions();

		// Set up search panel class
		if ($this->SearchWhere != "")
			AppendClass($this->SearchPanelClass, "show");

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
			$this->id->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->id->OldValue))
				return FALSE;
		}
		return TRUE;
	}

	// Get list of filters
	public function getFilterList()
	{
		global $UserProfile;

		// Initialize
		$filterList = "";
		$savedFilterList = "";
		$filterList = Concat($filterList, $this->id->AdvancedSearch->toJson(), ","); // Field id
		$filterList = Concat($filterList, $this->kode_penjualan->AdvancedSearch->toJson(), ","); // Field kode_penjualan
		$filterList = Concat($filterList, $this->id_pelanggan->AdvancedSearch->toJson(), ","); // Field id_pelanggan
		$filterList = Concat($filterList, $this->id_member->AdvancedSearch->toJson(), ","); // Field id_member
		$filterList = Concat($filterList, $this->waktu->AdvancedSearch->toJson(), ","); // Field waktu
		$filterList = Concat($filterList, $this->diskon_persen->AdvancedSearch->toJson(), ","); // Field diskon_persen
		$filterList = Concat($filterList, $this->diskon_rupiah->AdvancedSearch->toJson(), ","); // Field diskon_rupiah
		$filterList = Concat($filterList, $this->ppn->AdvancedSearch->toJson(), ","); // Field ppn
		$filterList = Concat($filterList, $this->total->AdvancedSearch->toJson(), ","); // Field total
		$filterList = Concat($filterList, $this->bayar->AdvancedSearch->toJson(), ","); // Field bayar
		$filterList = Concat($filterList, $this->bayar_non_tunai->AdvancedSearch->toJson(), ","); // Field bayar_non_tunai
		$filterList = Concat($filterList, $this->total_non_tunai_charge->AdvancedSearch->toJson(), ","); // Field total_non_tunai_charge
		$filterList = Concat($filterList, $this->keterangan->AdvancedSearch->toJson(), ","); // Field keterangan
		$filterList = Concat($filterList, $this->id_klinik->AdvancedSearch->toJson(), ","); // Field id_klinik
		$filterList = Concat($filterList, $this->id_rmd->AdvancedSearch->toJson(), ","); // Field id_rmd
		$filterList = Concat($filterList, $this->metode_pembayaran->AdvancedSearch->toJson(), ","); // Field metode_pembayaran
		$filterList = Concat($filterList, $this->id_bank->AdvancedSearch->toJson(), ","); // Field id_bank
		$filterList = Concat($filterList, $this->id_kartu->AdvancedSearch->toJson(), ","); // Field id_kartu
		$filterList = Concat($filterList, $this->sales->AdvancedSearch->toJson(), ","); // Field sales
		$filterList = Concat($filterList, $this->dok_be_wajah->AdvancedSearch->toJson(), ","); // Field dok_be_wajah
		$filterList = Concat($filterList, $this->be_body->AdvancedSearch->toJson(), ","); // Field be_body
		$filterList = Concat($filterList, $this->medis->AdvancedSearch->toJson(), ","); // Field medis
		$filterList = Concat($filterList, $this->dokter->AdvancedSearch->toJson(), ","); // Field dokter
		$filterList = Concat($filterList, $this->id_kartubank->AdvancedSearch->toJson(), ","); // Field id_kartubank
		$filterList = Concat($filterList, $this->id_kas->AdvancedSearch->toJson(), ","); // Field id_kas
		$filterList = Concat($filterList, $this->charge->AdvancedSearch->toJson(), ","); // Field charge
		$filterList = Concat($filterList, $this->klaim_poin->AdvancedSearch->toJson(), ","); // Field klaim_poin
		$filterList = Concat($filterList, $this->total_penukaran_poin->AdvancedSearch->toJson(), ","); // Field total_penukaran_poin
		$filterList = Concat($filterList, $this->ongkir->AdvancedSearch->toJson(), ","); // Field ongkir
		$filterList = Concat($filterList, $this->_action->AdvancedSearch->toJson(), ","); // Field action
		$filterList = Concat($filterList, $this->status->AdvancedSearch->toJson(), ","); // Field status
		$filterList = Concat($filterList, $this->status_void->AdvancedSearch->toJson(), ","); // Field status_void
		if ($this->BasicSearch->Keyword != "") {
			$wrk = "\"" . Config("TABLE_BASIC_SEARCH") . "\":\"" . JsEncode($this->BasicSearch->Keyword) . "\",\"" . Config("TABLE_BASIC_SEARCH_TYPE") . "\":\"" . JsEncode($this->BasicSearch->Type) . "\"";
			$filterList = Concat($filterList, $wrk, ",");
		}

		// Return filter list in JSON
		if ($filterList != "")
			$filterList = "\"data\":{" . $filterList . "}";
		if ($savedFilterList != "")
			$filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
		return ($filterList != "") ? "{" . $filterList . "}" : "null";
	}

	// Process filter list
	protected function processFilterList()
	{
		global $UserProfile;
		if (Post("ajax") == "savefilters") { // Save filter request (Ajax)
			$filters = Post("filters");
			$UserProfile->setSearchFilters(CurrentUserName(), "fpenjualanlistsrch", $filters);
			WriteJson([["success" => TRUE]]); // Success
			return TRUE;
		} elseif (Post("cmd") == "resetfilter") {
			$this->restoreFilterList();
		}
		return FALSE;
	}

	// Restore list of filters
	protected function restoreFilterList()
	{

		// Return if not reset filter
		if (Post("cmd") !== "resetfilter")
			return FALSE;
		$filter = json_decode(Post("filter"), TRUE);
		$this->Command = "search";

		// Field id
		$this->id->AdvancedSearch->SearchValue = @$filter["x_id"];
		$this->id->AdvancedSearch->SearchOperator = @$filter["z_id"];
		$this->id->AdvancedSearch->SearchCondition = @$filter["v_id"];
		$this->id->AdvancedSearch->SearchValue2 = @$filter["y_id"];
		$this->id->AdvancedSearch->SearchOperator2 = @$filter["w_id"];
		$this->id->AdvancedSearch->save();

		// Field kode_penjualan
		$this->kode_penjualan->AdvancedSearch->SearchValue = @$filter["x_kode_penjualan"];
		$this->kode_penjualan->AdvancedSearch->SearchOperator = @$filter["z_kode_penjualan"];
		$this->kode_penjualan->AdvancedSearch->SearchCondition = @$filter["v_kode_penjualan"];
		$this->kode_penjualan->AdvancedSearch->SearchValue2 = @$filter["y_kode_penjualan"];
		$this->kode_penjualan->AdvancedSearch->SearchOperator2 = @$filter["w_kode_penjualan"];
		$this->kode_penjualan->AdvancedSearch->save();

		// Field id_pelanggan
		$this->id_pelanggan->AdvancedSearch->SearchValue = @$filter["x_id_pelanggan"];
		$this->id_pelanggan->AdvancedSearch->SearchOperator = @$filter["z_id_pelanggan"];
		$this->id_pelanggan->AdvancedSearch->SearchCondition = @$filter["v_id_pelanggan"];
		$this->id_pelanggan->AdvancedSearch->SearchValue2 = @$filter["y_id_pelanggan"];
		$this->id_pelanggan->AdvancedSearch->SearchOperator2 = @$filter["w_id_pelanggan"];
		$this->id_pelanggan->AdvancedSearch->save();

		// Field id_member
		$this->id_member->AdvancedSearch->SearchValue = @$filter["x_id_member"];
		$this->id_member->AdvancedSearch->SearchOperator = @$filter["z_id_member"];
		$this->id_member->AdvancedSearch->SearchCondition = @$filter["v_id_member"];
		$this->id_member->AdvancedSearch->SearchValue2 = @$filter["y_id_member"];
		$this->id_member->AdvancedSearch->SearchOperator2 = @$filter["w_id_member"];
		$this->id_member->AdvancedSearch->save();

		// Field waktu
		$this->waktu->AdvancedSearch->SearchValue = @$filter["x_waktu"];
		$this->waktu->AdvancedSearch->SearchOperator = @$filter["z_waktu"];
		$this->waktu->AdvancedSearch->SearchCondition = @$filter["v_waktu"];
		$this->waktu->AdvancedSearch->SearchValue2 = @$filter["y_waktu"];
		$this->waktu->AdvancedSearch->SearchOperator2 = @$filter["w_waktu"];
		$this->waktu->AdvancedSearch->save();

		// Field diskon_persen
		$this->diskon_persen->AdvancedSearch->SearchValue = @$filter["x_diskon_persen"];
		$this->diskon_persen->AdvancedSearch->SearchOperator = @$filter["z_diskon_persen"];
		$this->diskon_persen->AdvancedSearch->SearchCondition = @$filter["v_diskon_persen"];
		$this->diskon_persen->AdvancedSearch->SearchValue2 = @$filter["y_diskon_persen"];
		$this->diskon_persen->AdvancedSearch->SearchOperator2 = @$filter["w_diskon_persen"];
		$this->diskon_persen->AdvancedSearch->save();

		// Field diskon_rupiah
		$this->diskon_rupiah->AdvancedSearch->SearchValue = @$filter["x_diskon_rupiah"];
		$this->diskon_rupiah->AdvancedSearch->SearchOperator = @$filter["z_diskon_rupiah"];
		$this->diskon_rupiah->AdvancedSearch->SearchCondition = @$filter["v_diskon_rupiah"];
		$this->diskon_rupiah->AdvancedSearch->SearchValue2 = @$filter["y_diskon_rupiah"];
		$this->diskon_rupiah->AdvancedSearch->SearchOperator2 = @$filter["w_diskon_rupiah"];
		$this->diskon_rupiah->AdvancedSearch->save();

		// Field ppn
		$this->ppn->AdvancedSearch->SearchValue = @$filter["x_ppn"];
		$this->ppn->AdvancedSearch->SearchOperator = @$filter["z_ppn"];
		$this->ppn->AdvancedSearch->SearchCondition = @$filter["v_ppn"];
		$this->ppn->AdvancedSearch->SearchValue2 = @$filter["y_ppn"];
		$this->ppn->AdvancedSearch->SearchOperator2 = @$filter["w_ppn"];
		$this->ppn->AdvancedSearch->save();

		// Field total
		$this->total->AdvancedSearch->SearchValue = @$filter["x_total"];
		$this->total->AdvancedSearch->SearchOperator = @$filter["z_total"];
		$this->total->AdvancedSearch->SearchCondition = @$filter["v_total"];
		$this->total->AdvancedSearch->SearchValue2 = @$filter["y_total"];
		$this->total->AdvancedSearch->SearchOperator2 = @$filter["w_total"];
		$this->total->AdvancedSearch->save();

		// Field bayar
		$this->bayar->AdvancedSearch->SearchValue = @$filter["x_bayar"];
		$this->bayar->AdvancedSearch->SearchOperator = @$filter["z_bayar"];
		$this->bayar->AdvancedSearch->SearchCondition = @$filter["v_bayar"];
		$this->bayar->AdvancedSearch->SearchValue2 = @$filter["y_bayar"];
		$this->bayar->AdvancedSearch->SearchOperator2 = @$filter["w_bayar"];
		$this->bayar->AdvancedSearch->save();

		// Field bayar_non_tunai
		$this->bayar_non_tunai->AdvancedSearch->SearchValue = @$filter["x_bayar_non_tunai"];
		$this->bayar_non_tunai->AdvancedSearch->SearchOperator = @$filter["z_bayar_non_tunai"];
		$this->bayar_non_tunai->AdvancedSearch->SearchCondition = @$filter["v_bayar_non_tunai"];
		$this->bayar_non_tunai->AdvancedSearch->SearchValue2 = @$filter["y_bayar_non_tunai"];
		$this->bayar_non_tunai->AdvancedSearch->SearchOperator2 = @$filter["w_bayar_non_tunai"];
		$this->bayar_non_tunai->AdvancedSearch->save();

		// Field total_non_tunai_charge
		$this->total_non_tunai_charge->AdvancedSearch->SearchValue = @$filter["x_total_non_tunai_charge"];
		$this->total_non_tunai_charge->AdvancedSearch->SearchOperator = @$filter["z_total_non_tunai_charge"];
		$this->total_non_tunai_charge->AdvancedSearch->SearchCondition = @$filter["v_total_non_tunai_charge"];
		$this->total_non_tunai_charge->AdvancedSearch->SearchValue2 = @$filter["y_total_non_tunai_charge"];
		$this->total_non_tunai_charge->AdvancedSearch->SearchOperator2 = @$filter["w_total_non_tunai_charge"];
		$this->total_non_tunai_charge->AdvancedSearch->save();

		// Field keterangan
		$this->keterangan->AdvancedSearch->SearchValue = @$filter["x_keterangan"];
		$this->keterangan->AdvancedSearch->SearchOperator = @$filter["z_keterangan"];
		$this->keterangan->AdvancedSearch->SearchCondition = @$filter["v_keterangan"];
		$this->keterangan->AdvancedSearch->SearchValue2 = @$filter["y_keterangan"];
		$this->keterangan->AdvancedSearch->SearchOperator2 = @$filter["w_keterangan"];
		$this->keterangan->AdvancedSearch->save();

		// Field id_klinik
		$this->id_klinik->AdvancedSearch->SearchValue = @$filter["x_id_klinik"];
		$this->id_klinik->AdvancedSearch->SearchOperator = @$filter["z_id_klinik"];
		$this->id_klinik->AdvancedSearch->SearchCondition = @$filter["v_id_klinik"];
		$this->id_klinik->AdvancedSearch->SearchValue2 = @$filter["y_id_klinik"];
		$this->id_klinik->AdvancedSearch->SearchOperator2 = @$filter["w_id_klinik"];
		$this->id_klinik->AdvancedSearch->save();

		// Field id_rmd
		$this->id_rmd->AdvancedSearch->SearchValue = @$filter["x_id_rmd"];
		$this->id_rmd->AdvancedSearch->SearchOperator = @$filter["z_id_rmd"];
		$this->id_rmd->AdvancedSearch->SearchCondition = @$filter["v_id_rmd"];
		$this->id_rmd->AdvancedSearch->SearchValue2 = @$filter["y_id_rmd"];
		$this->id_rmd->AdvancedSearch->SearchOperator2 = @$filter["w_id_rmd"];
		$this->id_rmd->AdvancedSearch->save();

		// Field metode_pembayaran
		$this->metode_pembayaran->AdvancedSearch->SearchValue = @$filter["x_metode_pembayaran"];
		$this->metode_pembayaran->AdvancedSearch->SearchOperator = @$filter["z_metode_pembayaran"];
		$this->metode_pembayaran->AdvancedSearch->SearchCondition = @$filter["v_metode_pembayaran"];
		$this->metode_pembayaran->AdvancedSearch->SearchValue2 = @$filter["y_metode_pembayaran"];
		$this->metode_pembayaran->AdvancedSearch->SearchOperator2 = @$filter["w_metode_pembayaran"];
		$this->metode_pembayaran->AdvancedSearch->save();

		// Field id_bank
		$this->id_bank->AdvancedSearch->SearchValue = @$filter["x_id_bank"];
		$this->id_bank->AdvancedSearch->SearchOperator = @$filter["z_id_bank"];
		$this->id_bank->AdvancedSearch->SearchCondition = @$filter["v_id_bank"];
		$this->id_bank->AdvancedSearch->SearchValue2 = @$filter["y_id_bank"];
		$this->id_bank->AdvancedSearch->SearchOperator2 = @$filter["w_id_bank"];
		$this->id_bank->AdvancedSearch->save();

		// Field id_kartu
		$this->id_kartu->AdvancedSearch->SearchValue = @$filter["x_id_kartu"];
		$this->id_kartu->AdvancedSearch->SearchOperator = @$filter["z_id_kartu"];
		$this->id_kartu->AdvancedSearch->SearchCondition = @$filter["v_id_kartu"];
		$this->id_kartu->AdvancedSearch->SearchValue2 = @$filter["y_id_kartu"];
		$this->id_kartu->AdvancedSearch->SearchOperator2 = @$filter["w_id_kartu"];
		$this->id_kartu->AdvancedSearch->save();

		// Field sales
		$this->sales->AdvancedSearch->SearchValue = @$filter["x_sales"];
		$this->sales->AdvancedSearch->SearchOperator = @$filter["z_sales"];
		$this->sales->AdvancedSearch->SearchCondition = @$filter["v_sales"];
		$this->sales->AdvancedSearch->SearchValue2 = @$filter["y_sales"];
		$this->sales->AdvancedSearch->SearchOperator2 = @$filter["w_sales"];
		$this->sales->AdvancedSearch->save();

		// Field dok_be_wajah
		$this->dok_be_wajah->AdvancedSearch->SearchValue = @$filter["x_dok_be_wajah"];
		$this->dok_be_wajah->AdvancedSearch->SearchOperator = @$filter["z_dok_be_wajah"];
		$this->dok_be_wajah->AdvancedSearch->SearchCondition = @$filter["v_dok_be_wajah"];
		$this->dok_be_wajah->AdvancedSearch->SearchValue2 = @$filter["y_dok_be_wajah"];
		$this->dok_be_wajah->AdvancedSearch->SearchOperator2 = @$filter["w_dok_be_wajah"];
		$this->dok_be_wajah->AdvancedSearch->save();

		// Field be_body
		$this->be_body->AdvancedSearch->SearchValue = @$filter["x_be_body"];
		$this->be_body->AdvancedSearch->SearchOperator = @$filter["z_be_body"];
		$this->be_body->AdvancedSearch->SearchCondition = @$filter["v_be_body"];
		$this->be_body->AdvancedSearch->SearchValue2 = @$filter["y_be_body"];
		$this->be_body->AdvancedSearch->SearchOperator2 = @$filter["w_be_body"];
		$this->be_body->AdvancedSearch->save();

		// Field medis
		$this->medis->AdvancedSearch->SearchValue = @$filter["x_medis"];
		$this->medis->AdvancedSearch->SearchOperator = @$filter["z_medis"];
		$this->medis->AdvancedSearch->SearchCondition = @$filter["v_medis"];
		$this->medis->AdvancedSearch->SearchValue2 = @$filter["y_medis"];
		$this->medis->AdvancedSearch->SearchOperator2 = @$filter["w_medis"];
		$this->medis->AdvancedSearch->save();

		// Field dokter
		$this->dokter->AdvancedSearch->SearchValue = @$filter["x_dokter"];
		$this->dokter->AdvancedSearch->SearchOperator = @$filter["z_dokter"];
		$this->dokter->AdvancedSearch->SearchCondition = @$filter["v_dokter"];
		$this->dokter->AdvancedSearch->SearchValue2 = @$filter["y_dokter"];
		$this->dokter->AdvancedSearch->SearchOperator2 = @$filter["w_dokter"];
		$this->dokter->AdvancedSearch->save();

		// Field id_kartubank
		$this->id_kartubank->AdvancedSearch->SearchValue = @$filter["x_id_kartubank"];
		$this->id_kartubank->AdvancedSearch->SearchOperator = @$filter["z_id_kartubank"];
		$this->id_kartubank->AdvancedSearch->SearchCondition = @$filter["v_id_kartubank"];
		$this->id_kartubank->AdvancedSearch->SearchValue2 = @$filter["y_id_kartubank"];
		$this->id_kartubank->AdvancedSearch->SearchOperator2 = @$filter["w_id_kartubank"];
		$this->id_kartubank->AdvancedSearch->save();

		// Field id_kas
		$this->id_kas->AdvancedSearch->SearchValue = @$filter["x_id_kas"];
		$this->id_kas->AdvancedSearch->SearchOperator = @$filter["z_id_kas"];
		$this->id_kas->AdvancedSearch->SearchCondition = @$filter["v_id_kas"];
		$this->id_kas->AdvancedSearch->SearchValue2 = @$filter["y_id_kas"];
		$this->id_kas->AdvancedSearch->SearchOperator2 = @$filter["w_id_kas"];
		$this->id_kas->AdvancedSearch->save();

		// Field charge
		$this->charge->AdvancedSearch->SearchValue = @$filter["x_charge"];
		$this->charge->AdvancedSearch->SearchOperator = @$filter["z_charge"];
		$this->charge->AdvancedSearch->SearchCondition = @$filter["v_charge"];
		$this->charge->AdvancedSearch->SearchValue2 = @$filter["y_charge"];
		$this->charge->AdvancedSearch->SearchOperator2 = @$filter["w_charge"];
		$this->charge->AdvancedSearch->save();

		// Field klaim_poin
		$this->klaim_poin->AdvancedSearch->SearchValue = @$filter["x_klaim_poin"];
		$this->klaim_poin->AdvancedSearch->SearchOperator = @$filter["z_klaim_poin"];
		$this->klaim_poin->AdvancedSearch->SearchCondition = @$filter["v_klaim_poin"];
		$this->klaim_poin->AdvancedSearch->SearchValue2 = @$filter["y_klaim_poin"];
		$this->klaim_poin->AdvancedSearch->SearchOperator2 = @$filter["w_klaim_poin"];
		$this->klaim_poin->AdvancedSearch->save();

		// Field total_penukaran_poin
		$this->total_penukaran_poin->AdvancedSearch->SearchValue = @$filter["x_total_penukaran_poin"];
		$this->total_penukaran_poin->AdvancedSearch->SearchOperator = @$filter["z_total_penukaran_poin"];
		$this->total_penukaran_poin->AdvancedSearch->SearchCondition = @$filter["v_total_penukaran_poin"];
		$this->total_penukaran_poin->AdvancedSearch->SearchValue2 = @$filter["y_total_penukaran_poin"];
		$this->total_penukaran_poin->AdvancedSearch->SearchOperator2 = @$filter["w_total_penukaran_poin"];
		$this->total_penukaran_poin->AdvancedSearch->save();

		// Field ongkir
		$this->ongkir->AdvancedSearch->SearchValue = @$filter["x_ongkir"];
		$this->ongkir->AdvancedSearch->SearchOperator = @$filter["z_ongkir"];
		$this->ongkir->AdvancedSearch->SearchCondition = @$filter["v_ongkir"];
		$this->ongkir->AdvancedSearch->SearchValue2 = @$filter["y_ongkir"];
		$this->ongkir->AdvancedSearch->SearchOperator2 = @$filter["w_ongkir"];
		$this->ongkir->AdvancedSearch->save();

		// Field action
		$this->_action->AdvancedSearch->SearchValue = @$filter["x__action"];
		$this->_action->AdvancedSearch->SearchOperator = @$filter["z__action"];
		$this->_action->AdvancedSearch->SearchCondition = @$filter["v__action"];
		$this->_action->AdvancedSearch->SearchValue2 = @$filter["y__action"];
		$this->_action->AdvancedSearch->SearchOperator2 = @$filter["w__action"];
		$this->_action->AdvancedSearch->save();

		// Field status
		$this->status->AdvancedSearch->SearchValue = @$filter["x_status"];
		$this->status->AdvancedSearch->SearchOperator = @$filter["z_status"];
		$this->status->AdvancedSearch->SearchCondition = @$filter["v_status"];
		$this->status->AdvancedSearch->SearchValue2 = @$filter["y_status"];
		$this->status->AdvancedSearch->SearchOperator2 = @$filter["w_status"];
		$this->status->AdvancedSearch->save();

		// Field status_void
		$this->status_void->AdvancedSearch->SearchValue = @$filter["x_status_void"];
		$this->status_void->AdvancedSearch->SearchOperator = @$filter["z_status_void"];
		$this->status_void->AdvancedSearch->SearchCondition = @$filter["v_status_void"];
		$this->status_void->AdvancedSearch->SearchValue2 = @$filter["y_status_void"];
		$this->status_void->AdvancedSearch->SearchOperator2 = @$filter["w_status_void"];
		$this->status_void->AdvancedSearch->save();
		$this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
		$this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
	}

	// Advanced search WHERE clause based on QueryString
	protected function advancedSearchWhere($default = FALSE)
	{
		global $Security;
		$where = "";
		if (!$Security->canSearch())
			return "";
		$this->buildSearchSql($where, $this->id, $default, FALSE); // id
		$this->buildSearchSql($where, $this->kode_penjualan, $default, FALSE); // kode_penjualan
		$this->buildSearchSql($where, $this->id_pelanggan, $default, FALSE); // id_pelanggan
		$this->buildSearchSql($where, $this->id_member, $default, FALSE); // id_member
		$this->buildSearchSql($where, $this->waktu, $default, FALSE); // waktu
		$this->buildSearchSql($where, $this->diskon_persen, $default, FALSE); // diskon_persen
		$this->buildSearchSql($where, $this->diskon_rupiah, $default, FALSE); // diskon_rupiah
		$this->buildSearchSql($where, $this->ppn, $default, FALSE); // ppn
		$this->buildSearchSql($where, $this->total, $default, FALSE); // total
		$this->buildSearchSql($where, $this->bayar, $default, FALSE); // bayar
		$this->buildSearchSql($where, $this->bayar_non_tunai, $default, FALSE); // bayar_non_tunai
		$this->buildSearchSql($where, $this->total_non_tunai_charge, $default, FALSE); // total_non_tunai_charge
		$this->buildSearchSql($where, $this->keterangan, $default, FALSE); // keterangan
		$this->buildSearchSql($where, $this->id_klinik, $default, FALSE); // id_klinik
		$this->buildSearchSql($where, $this->id_rmd, $default, FALSE); // id_rmd
		$this->buildSearchSql($where, $this->metode_pembayaran, $default, FALSE); // metode_pembayaran
		$this->buildSearchSql($where, $this->id_bank, $default, FALSE); // id_bank
		$this->buildSearchSql($where, $this->id_kartu, $default, FALSE); // id_kartu
		$this->buildSearchSql($where, $this->sales, $default, FALSE); // sales
		$this->buildSearchSql($where, $this->dok_be_wajah, $default, FALSE); // dok_be_wajah
		$this->buildSearchSql($where, $this->be_body, $default, FALSE); // be_body
		$this->buildSearchSql($where, $this->medis, $default, FALSE); // medis
		$this->buildSearchSql($where, $this->dokter, $default, FALSE); // dokter
		$this->buildSearchSql($where, $this->id_kartubank, $default, FALSE); // id_kartubank
		$this->buildSearchSql($where, $this->id_kas, $default, FALSE); // id_kas
		$this->buildSearchSql($where, $this->charge, $default, FALSE); // charge
		$this->buildSearchSql($where, $this->klaim_poin, $default, FALSE); // klaim_poin
		$this->buildSearchSql($where, $this->total_penukaran_poin, $default, FALSE); // total_penukaran_poin
		$this->buildSearchSql($where, $this->ongkir, $default, FALSE); // ongkir
		$this->buildSearchSql($where, $this->_action, $default, FALSE); // action
		$this->buildSearchSql($where, $this->status, $default, FALSE); // status
		$this->buildSearchSql($where, $this->status_void, $default, FALSE); // status_void

		// Set up search parm
		if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
			$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->id->AdvancedSearch->save(); // id
			$this->kode_penjualan->AdvancedSearch->save(); // kode_penjualan
			$this->id_pelanggan->AdvancedSearch->save(); // id_pelanggan
			$this->id_member->AdvancedSearch->save(); // id_member
			$this->waktu->AdvancedSearch->save(); // waktu
			$this->diskon_persen->AdvancedSearch->save(); // diskon_persen
			$this->diskon_rupiah->AdvancedSearch->save(); // diskon_rupiah
			$this->ppn->AdvancedSearch->save(); // ppn
			$this->total->AdvancedSearch->save(); // total
			$this->bayar->AdvancedSearch->save(); // bayar
			$this->bayar_non_tunai->AdvancedSearch->save(); // bayar_non_tunai
			$this->total_non_tunai_charge->AdvancedSearch->save(); // total_non_tunai_charge
			$this->keterangan->AdvancedSearch->save(); // keterangan
			$this->id_klinik->AdvancedSearch->save(); // id_klinik
			$this->id_rmd->AdvancedSearch->save(); // id_rmd
			$this->metode_pembayaran->AdvancedSearch->save(); // metode_pembayaran
			$this->id_bank->AdvancedSearch->save(); // id_bank
			$this->id_kartu->AdvancedSearch->save(); // id_kartu
			$this->sales->AdvancedSearch->save(); // sales
			$this->dok_be_wajah->AdvancedSearch->save(); // dok_be_wajah
			$this->be_body->AdvancedSearch->save(); // be_body
			$this->medis->AdvancedSearch->save(); // medis
			$this->dokter->AdvancedSearch->save(); // dokter
			$this->id_kartubank->AdvancedSearch->save(); // id_kartubank
			$this->id_kas->AdvancedSearch->save(); // id_kas
			$this->charge->AdvancedSearch->save(); // charge
			$this->klaim_poin->AdvancedSearch->save(); // klaim_poin
			$this->total_penukaran_poin->AdvancedSearch->save(); // total_penukaran_poin
			$this->ongkir->AdvancedSearch->save(); // ongkir
			$this->_action->AdvancedSearch->save(); // action
			$this->status->AdvancedSearch->save(); // status
			$this->status_void->AdvancedSearch->save(); // status_void
		}
		return $where;
	}

	// Build search SQL
	protected function buildSearchSql(&$where, &$fld, $default, $multiValue)
	{
		$fldParm = $fld->Param;
		$fldVal = ($default) ? $fld->AdvancedSearch->SearchValueDefault : $fld->AdvancedSearch->SearchValue;
		$fldOpr = ($default) ? $fld->AdvancedSearch->SearchOperatorDefault : $fld->AdvancedSearch->SearchOperator;
		$fldCond = ($default) ? $fld->AdvancedSearch->SearchConditionDefault : $fld->AdvancedSearch->SearchCondition;
		$fldVal2 = ($default) ? $fld->AdvancedSearch->SearchValue2Default : $fld->AdvancedSearch->SearchValue2;
		$fldOpr2 = ($default) ? $fld->AdvancedSearch->SearchOperator2Default : $fld->AdvancedSearch->SearchOperator2;
		$wrk = "";
		if (is_array($fldVal))
			$fldVal = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal);
		if (is_array($fldVal2))
			$fldVal2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal2);
		$fldOpr = strtoupper(trim($fldOpr));
		if ($fldOpr == "")
			$fldOpr = "=";
		$fldOpr2 = strtoupper(trim($fldOpr2));
		if ($fldOpr2 == "")
			$fldOpr2 = "=";
		if (Config("SEARCH_MULTI_VALUE_OPTION") == 1 || !IsMultiSearchOperator($fldOpr))
			$multiValue = FALSE;
		if ($multiValue) {
			$wrk1 = ($fldVal != "") ? GetMultiSearchSql($fld, $fldOpr, $fldVal, $this->Dbid) : ""; // Field value 1
			$wrk2 = ($fldVal2 != "") ? GetMultiSearchSql($fld, $fldOpr2, $fldVal2, $this->Dbid) : ""; // Field value 2
			$wrk = $wrk1; // Build final SQL
			if ($wrk2 != "")
				$wrk = ($wrk != "") ? "($wrk) $fldCond ($wrk2)" : $wrk2;
		} else {
			$fldVal = $this->convertSearchValue($fld, $fldVal);
			$fldVal2 = $this->convertSearchValue($fld, $fldVal2);
			$wrk = GetSearchSql($fld, $fldVal, $fldOpr, $fldCond, $fldVal2, $fldOpr2, $this->Dbid);
		}
		AddFilter($where, $wrk);
	}

	// Convert search value
	protected function convertSearchValue(&$fld, $fldVal)
	{
		if ($fldVal == Config("NULL_VALUE") || $fldVal == Config("NOT_NULL_VALUE"))
			return $fldVal;
		$value = $fldVal;
		if ($fld->isBoolean()) {
			if ($fldVal != "")
				$value = (SameText($fldVal, "1") || SameText($fldVal, "y") || SameText($fldVal, "t")) ? $fld->TrueValue : $fld->FalseValue;
		} elseif ($fld->DataType == DATATYPE_DATE || $fld->DataType == DATATYPE_TIME) {
			if ($fldVal != "")
				$value = UnFormatDateTime($fldVal, $fld->DateTimeFormat);
		}
		return $value;
	}

	// Return basic search SQL
	protected function basicSearchSql($arKeywords, $type)
	{
		$where = "";
		$this->buildBasicSearchSql($where, $this->kode_penjualan, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->id_pelanggan, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->id_member, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->keterangan, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->metode_pembayaran, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->sales, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->dok_be_wajah, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->be_body, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->medis, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->dokter, $arKeywords, $type);
		$this->buildBasicSearchSql($where, $this->id_kartubank, $arKeywords, $type);
		return $where;
	}

	// Build basic search SQL
	protected function buildBasicSearchSql(&$where, &$fld, $arKeywords, $type)
	{
		$defCond = ($type == "OR") ? "OR" : "AND";
		$arSql = []; // Array for SQL parts
		$arCond = []; // Array for search conditions
		$cnt = count($arKeywords);
		$j = 0; // Number of SQL parts
		for ($i = 0; $i < $cnt; $i++) {
			$keyword = $arKeywords[$i];
			$keyword = trim($keyword);
			if (Config("BASIC_SEARCH_IGNORE_PATTERN") != "") {
				$keyword = preg_replace(Config("BASIC_SEARCH_IGNORE_PATTERN"), "\\", $keyword);
				$ar = explode("\\", $keyword);
			} else {
				$ar = [$keyword];
			}
			foreach ($ar as $keyword) {
				if ($keyword != "") {
					$wrk = "";
					if ($keyword == "OR" && $type == "") {
						if ($j > 0)
							$arCond[$j - 1] = "OR";
					} elseif ($keyword == Config("NULL_VALUE")) {
						$wrk = $fld->Expression . " IS NULL";
					} elseif ($keyword == Config("NOT_NULL_VALUE")) {
						$wrk = $fld->Expression . " IS NOT NULL";
					} elseif ($fld->IsVirtual) {
						$wrk = $fld->VirtualExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					} elseif ($fld->DataType != DATATYPE_NUMBER || is_numeric($keyword)) {
						$wrk = $fld->BasicSearchExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
					}
					if ($wrk != "") {
						$arSql[$j] = $wrk;
						$arCond[$j] = $defCond;
						$j += 1;
					}
				}
			}
		}
		$cnt = count($arSql);
		$quoted = FALSE;
		$sql = "";
		if ($cnt > 0) {
			for ($i = 0; $i < $cnt - 1; $i++) {
				if ($arCond[$i] == "OR") {
					if (!$quoted)
						$sql .= "(";
					$quoted = TRUE;
				}
				$sql .= $arSql[$i];
				if ($quoted && $arCond[$i] != "OR") {
					$sql .= ")";
					$quoted = FALSE;
				}
				$sql .= " " . $arCond[$i] . " ";
			}
			$sql .= $arSql[$cnt - 1];
			if ($quoted)
				$sql .= ")";
		}
		if ($sql != "") {
			if ($where != "")
				$where .= " OR ";
			$where .= "(" . $sql . ")";
		}
	}

	// Return basic search WHERE clause based on search keyword and type
	protected function basicSearchWhere($default = FALSE)
	{
		global $Security;
		$searchStr = "";
		if (!$Security->canSearch())
			return "";
		$searchKeyword = ($default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
		$searchType = ($default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

		// Get search SQL
		if ($searchKeyword != "") {
			$ar = $this->BasicSearch->keywordList($default);

			// Search keyword in any fields
			if (($searchType == "OR" || $searchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
				foreach ($ar as $keyword) {
					if ($keyword != "") {
						if ($searchStr != "")
							$searchStr .= " " . $searchType . " ";
						$searchStr .= "(" . $this->basicSearchSql([$keyword], $searchType) . ")";
					}
				}
			} else {
				$searchStr = $this->basicSearchSql($ar, $searchType);
			}
			if (!$default && in_array($this->Command, ["", "reset", "resetall"]))
				$this->Command = "search";
		}
		if (!$default && $this->Command == "search") {
			$this->BasicSearch->setKeyword($searchKeyword);
			$this->BasicSearch->setType($searchType);
		}
		return $searchStr;
	}

	// Check if search parm exists
	protected function checkSearchParms()
	{

		// Check basic search
		if ($this->BasicSearch->issetSession())
			return TRUE;
		if ($this->id->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->kode_penjualan->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->id_pelanggan->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->id_member->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->waktu->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->diskon_persen->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->diskon_rupiah->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ppn->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->total->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->bayar->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->bayar_non_tunai->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->total_non_tunai_charge->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->keterangan->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->id_klinik->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->id_rmd->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->metode_pembayaran->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->id_bank->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->id_kartu->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->sales->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->dok_be_wajah->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->be_body->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->medis->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->dokter->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->id_kartubank->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->id_kas->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->charge->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->klaim_poin->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->total_penukaran_poin->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->ongkir->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->_action->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->status->AdvancedSearch->issetSession())
			return TRUE;
		if ($this->status_void->AdvancedSearch->issetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	protected function resetSearchParms()
	{

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->resetBasicSearchParms();

		// Clear advanced search parameters
		$this->resetAdvancedSearchParms();
	}

	// Load advanced search default values
	protected function loadAdvancedSearchDefault()
	{
		return FALSE;
	}

	// Clear all basic search parameters
	protected function resetBasicSearchParms()
	{
		$this->BasicSearch->unsetSession();
	}

	// Clear all advanced search parameters
	protected function resetAdvancedSearchParms()
	{
		$this->id->AdvancedSearch->unsetSession();
		$this->kode_penjualan->AdvancedSearch->unsetSession();
		$this->id_pelanggan->AdvancedSearch->unsetSession();
		$this->id_member->AdvancedSearch->unsetSession();
		$this->waktu->AdvancedSearch->unsetSession();
		$this->diskon_persen->AdvancedSearch->unsetSession();
		$this->diskon_rupiah->AdvancedSearch->unsetSession();
		$this->ppn->AdvancedSearch->unsetSession();
		$this->total->AdvancedSearch->unsetSession();
		$this->bayar->AdvancedSearch->unsetSession();
		$this->bayar_non_tunai->AdvancedSearch->unsetSession();
		$this->total_non_tunai_charge->AdvancedSearch->unsetSession();
		$this->keterangan->AdvancedSearch->unsetSession();
		$this->id_klinik->AdvancedSearch->unsetSession();
		$this->id_rmd->AdvancedSearch->unsetSession();
		$this->metode_pembayaran->AdvancedSearch->unsetSession();
		$this->id_bank->AdvancedSearch->unsetSession();
		$this->id_kartu->AdvancedSearch->unsetSession();
		$this->sales->AdvancedSearch->unsetSession();
		$this->dok_be_wajah->AdvancedSearch->unsetSession();
		$this->be_body->AdvancedSearch->unsetSession();
		$this->medis->AdvancedSearch->unsetSession();
		$this->dokter->AdvancedSearch->unsetSession();
		$this->id_kartubank->AdvancedSearch->unsetSession();
		$this->id_kas->AdvancedSearch->unsetSession();
		$this->charge->AdvancedSearch->unsetSession();
		$this->klaim_poin->AdvancedSearch->unsetSession();
		$this->total_penukaran_poin->AdvancedSearch->unsetSession();
		$this->ongkir->AdvancedSearch->unsetSession();
		$this->_action->AdvancedSearch->unsetSession();
		$this->status->AdvancedSearch->unsetSession();
		$this->status_void->AdvancedSearch->unsetSession();
	}

	// Restore all search parameters
	protected function restoreSearchParms()
	{
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->load();

		// Restore advanced search values
		$this->id->AdvancedSearch->load();
		$this->kode_penjualan->AdvancedSearch->load();
		$this->id_pelanggan->AdvancedSearch->load();
		$this->id_member->AdvancedSearch->load();
		$this->waktu->AdvancedSearch->load();
		$this->diskon_persen->AdvancedSearch->load();
		$this->diskon_rupiah->AdvancedSearch->load();
		$this->ppn->AdvancedSearch->load();
		$this->total->AdvancedSearch->load();
		$this->bayar->AdvancedSearch->load();
		$this->bayar_non_tunai->AdvancedSearch->load();
		$this->total_non_tunai_charge->AdvancedSearch->load();
		$this->keterangan->AdvancedSearch->load();
		$this->id_klinik->AdvancedSearch->load();
		$this->id_rmd->AdvancedSearch->load();
		$this->metode_pembayaran->AdvancedSearch->load();
		$this->id_bank->AdvancedSearch->load();
		$this->id_kartu->AdvancedSearch->load();
		$this->sales->AdvancedSearch->load();
		$this->dok_be_wajah->AdvancedSearch->load();
		$this->be_body->AdvancedSearch->load();
		$this->medis->AdvancedSearch->load();
		$this->dokter->AdvancedSearch->load();
		$this->id_kartubank->AdvancedSearch->load();
		$this->id_kas->AdvancedSearch->load();
		$this->charge->AdvancedSearch->load();
		$this->klaim_poin->AdvancedSearch->load();
		$this->total_penukaran_poin->AdvancedSearch->load();
		$this->ongkir->AdvancedSearch->load();
		$this->_action->AdvancedSearch->load();
		$this->status->AdvancedSearch->load();
		$this->status_void->AdvancedSearch->load();
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->updateSort($this->kode_penjualan); // kode_penjualan
			$this->updateSort($this->id_pelanggan); // id_pelanggan
			$this->updateSort($this->waktu); // waktu
			$this->updateSort($this->total); // total
			$this->updateSort($this->bayar); // bayar
			$this->updateSort($this->total_non_tunai_charge); // total_non_tunai_charge
			$this->updateSort($this->metode_pembayaran); // metode_pembayaran
			$this->updateSort($this->id_kartubank); // id_kartubank
			$this->updateSort($this->id_kas); // id_kas
			$this->updateSort($this->charge); // charge
			$this->updateSort($this->klaim_poin); // klaim_poin
			$this->updateSort($this->total_penukaran_poin); // total_penukaran_poin
			$this->updateSort($this->status); // status
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

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->resetSearchParms();

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
				$this->setSessionOrderByList($orderBy);
				$this->kode_penjualan->setSort("");
				$this->id_pelanggan->setSort("");
				$this->waktu->setSort("");
				$this->total->setSort("");
				$this->bayar->setSort("");
				$this->total_non_tunai_charge->setSort("");
				$this->metode_pembayaran->setSort("");
				$this->id_kartubank->setSort("");
				$this->id_kas->setSort("");
				$this->charge->setSort("");
				$this->klaim_poin->setSort("");
				$this->total_penukaran_poin->setSort("");
				$this->status->setSort("");
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

		// "detail_detailpenjualan"
		$item = &$this->ListOptions->add("detail_detailpenjualan");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->allowList(CurrentProjectID() . 'detailpenjualan') && !$this->ShowMultipleDetails;
		$item->OnLeft = FALSE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["detailpenjualan_grid"]))
			$GLOBALS["detailpenjualan_grid"] = new detailpenjualan_grid();

		// Multiple details
		if ($this->ShowMultipleDetails) {
			$item = &$this->ListOptions->add("details");
			$item->CssClass = "text-nowrap";
			$item->Visible = $this->ShowMultipleDetails;
			$item->OnLeft = FALSE;
			$item->ShowInButtonGroup = FALSE;
		}

		// Set up detail pages
		$pages = new SubPages();
		$pages->add("detailpenjualan");
		$this->DetailPages = $pages;

		// List actions
		$item = &$this->ListOptions->add("listactions");
		$item->CssClass = "text-nowrap";
		$item->OnLeft = FALSE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->add("checkbox");
		$item->Visible = FALSE;
		$item->OnLeft = FALSE;
		$item->Header = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" name=\"key\" id=\"key\" class=\"custom-control-input\" onclick=\"ew.selectAllKey(this);\"><label class=\"custom-control-label\" for=\"key\"></label></div>";
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;

		//$this->ListOptions->ButtonClass = ""; // Class for button group
		// Call ListOptions_Load event

		$this->ListOptions_Load();
		$this->setupListOptionsExt();
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

		// Set up list action buttons
		$opt = $this->ListOptions["listactions"];
		if ($opt && !$this->isExport() && !$this->CurrentAction) {
			$body = "";
			$links = [];
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode(str_replace(" ew-icon", "", $listaction->Icon)) . "\" data-caption=\"" . HtmlTitle($caption) . "\"></i> " : "";
					$links[] = "<li><a class=\"dropdown-item ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(TRUE) . "}," . $listaction->toJson(TRUE) . "));\">" . $icon . $listaction->Caption . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default ew-actions\" title=\"" . HtmlTitle($Language->phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("ListActionButton") . "</button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($opt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group btn-group-sm\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$opt->Body = $body;
				$opt->Visible = TRUE;
			}
		}
		$detailViewTblVar = "";
		$detailCopyTblVar = "";
		$detailEditTblVar = "";

		// "detail_detailpenjualan"
		$opt = $this->ListOptions["detail_detailpenjualan"];
		if ($Security->allowList(CurrentProjectID() . 'detailpenjualan')) {
			$body = $Language->phrase("DetailLink") . $Language->TablePhrase("detailpenjualan", "TblCaption");
			$body .= "&nbsp;" . str_replace("%c", $this->detailpenjualan_Count, $Language->phrase("DetailCount"));
			$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("detailpenjualanlist.php?" . Config("TABLE_SHOW_MASTER") . "=penjualan&fk_id=" . urlencode(strval($this->id->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["detailpenjualan_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'penjualan')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=detailpenjualan");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailViewTblVar != "")
					$detailViewTblVar .= ",";
				$detailViewTblVar .= "detailpenjualan";
			}
			if ($GLOBALS["detailpenjualan_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'penjualan')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=detailpenjualan");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailEditTblVar != "")
					$detailEditTblVar .= ",";
				$detailEditTblVar .= "detailpenjualan";
			}
			if ($GLOBALS["detailpenjualan_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'penjualan')) {
				$caption = $Language->phrase("MasterDetailCopyLink");
				$url = $this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=detailpenjualan");
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . HtmlImageAndText($caption) . "</a></li>";
				if ($detailCopyTblVar != "")
					$detailCopyTblVar .= ",";
				$detailCopyTblVar .= "detailpenjualan";
			}
			if ($links != "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
				$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
			}
			$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
			$opt->Body = $body;
			if ($this->ShowMultipleDetails)
				$opt->Visible = FALSE;
		}
		if ($this->ShowMultipleDetails) {
			$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">";
			$links = "";
			if ($detailViewTblVar != "") {
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailViewTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			}
			if ($detailEditTblVar != "") {
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailEditTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			}
			if ($detailCopyTblVar != "") {
				$links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailCopyLink")) . "\" href=\"" . HtmlEncode($this->GetCopyUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailCopyTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailCopyLink")) . "</a></li>";
			}
			if ($links != "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default ew-master-detail\" title=\"" . HtmlTitle($Language->phrase("MultipleMasterDetails")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("MultipleMasterDetails") . "</button>";
				$body .= "<ul class=\"dropdown-menu ew-menu\">". $links . "</ul>";
			}
			$body .= "</div>";

			// Multiple details
			$opt = $this->ListOptions["details"];
			$opt->Body = $body;
		}

		// "checkbox"
		$opt = $this->ListOptions["checkbox"];
		$opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->id->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
		$this->renderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["addedit"];

		// Add
		$item = &$option->add("add");
		$addcaption = HtmlTitle($Language->phrase("AddLink"));
		$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("AddLink") . "</a>";
		$item->Visible = $this->AddUrl != "" && $Security->canAdd();
		$option = $options["detail"];
		$detailTableLink = "";
		$item = &$option->add("detailadd_detailpenjualan");
		$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=detailpenjualan");
		if (!isset($GLOBALS["detailpenjualan"]))
			$GLOBALS["detailpenjualan"] = new detailpenjualan();
		$caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $GLOBALS["detailpenjualan"]->tableCaption();
		$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["detailpenjualan"]->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'penjualan') && $Security->canAdd());
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "detailpenjualan";
		}

		// Add multiple details
		if ($this->ShowMultipleDetails) {
			$item = &$option->add("detailsadd");
			$url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailTableLink);
			$caption = $Language->phrase("AddMasterDetailLink");
			$item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
			$item->Visible = $detailTableLink != "" && $Security->canAdd();

			// Hide single master/detail items
			$ar = explode(",", $detailTableLink);
			$cnt = count($ar);
			for ($i = 0; $i < $cnt; $i++) {
				if ($item = $option["detailadd_" . $ar[$i]])
					$item->Visible = FALSE;
			}
		}
		$option = $options["action"];

		// Set up options default
		foreach ($options as $option) {
			$option->UseDropDownButton = FALSE;
			$option->UseButtonGroup = TRUE;

			//$option->ButtonClass = ""; // Class for button group
			$item = &$option->add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->add("savecurrentfilter");
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fpenjualanlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fpenjualanlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	public function renderOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
			$option = $options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == ACTION_MULTIPLE) {
					$item = &$option->add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode($listaction->Icon) . "\" data-caption=\"" . HtmlEncode($caption) . "\"></i> " . $caption : $caption;
					$item->Body = "<a class=\"ew-action ew-list-action\" title=\"" . HtmlEncode($caption) . "\" data-caption=\"" . HtmlEncode($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({f:document.fpenjualanlist}," . $listaction->toJson(TRUE) . "));\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecords <= 0) {
				$option = $options["addedit"];
				$item = $option["gridedit"];
				if ($item)
					$item->Visible = FALSE;
				$option = $options["action"];
				$option->hideAllOptions();
			}
	}

	// Process list action
	protected function processListAction()
	{
		global $Language, $Security;
		$userlist = "";
		$user = "";
		$filter = $this->getFilterFromRecordKeys();
		$userAction = Post("useraction", "");
		if ($filter != "" && $userAction != "") {

			// Check permission first
			$actionCaption = $userAction;
			if (array_key_exists($userAction, $this->ListActions->Items)) {
				$actionCaption = $this->ListActions[$userAction]->Caption;
				if (!$this->ListActions[$userAction]->Allow) {
					$errmsg = str_replace('%s', $actionCaption, $Language->phrase("CustomActionNotAllowed"));
					if (Post("ajax") == $userAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $filter;
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$rs = $conn->execute($sql);
			$conn->raiseErrorFn = "";
			$this->CurrentAction = $userAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->beginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$processed = $this->Row_CustomAction($userAction, $row);
					if (!$processed)
						break;
					$rs->moveNext();
				}
				if ($processed) {
					$conn->commitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "" && !ob_get_length()) // No output
						$this->setSuccessMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->rollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage != "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->close();
			$this->CurrentAction = ""; // Clear action
			if (Post("ajax") == $userAction) { // Ajax
				if ($this->getSuccessMessage() != "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->clearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() != "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->clearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
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
		$links = "";
		$btngrps = "";
		$sqlwrk = "`id_penjualan`=" . AdjustSql($this->id->CurrentValue, $this->Dbid) . "";

		// Column "detail_detailpenjualan"
		if ($this->DetailPages && $this->DetailPages["detailpenjualan"] && $this->DetailPages["detailpenjualan"]->Visible) {
			$link = "";
			$option = $this->ListOptions["detail_detailpenjualan"];
			$url = "detailpenjualanpreview.php?t=penjualan&f=" . Encrypt($sqlwrk);
			$btngrp = "<div data-table=\"detailpenjualan\" data-url=\"" . $url . "\">";
			if ($Security->allowList(CurrentProjectID() . 'penjualan')) {
				$label = $Language->TablePhrase("detailpenjualan", "TblCaption");
				$label .= "&nbsp;" . JsEncode(str_replace("%c", $this->detailpenjualan_Count, $Language->phrase("DetailCount")));
				$link = "<li class=\"nav-item\"><a href=\"#\" class=\"nav-link\" data-toggle=\"tab\" data-table=\"detailpenjualan\" data-url=\"" . $url . "\">" . $label . "</a></li>";
				$links .= $link;
				$detaillnk = JsEncodeAttribute("detailpenjualanlist.php?" . Config("TABLE_SHOW_MASTER") . "=penjualan&fk_id=" . urlencode(strval($this->id->CurrentValue)) . "");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . $Language->TablePhrase("detailpenjualan", "TblCaption") . "\" onclick=\"window.location='" . $detaillnk . "';return false;\">" . $Language->phrase("MasterDetailListLink") . "</a>";
			}
			if (!isset($GLOBALS["detailpenjualan_grid"]))
				$GLOBALS["detailpenjualan_grid"] = new detailpenjualan_grid();
			if ($GLOBALS["detailpenjualan_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'penjualan')) {
				$caption = $Language->phrase("MasterDetailViewLink");
				$url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=detailpenjualan");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["detailpenjualan_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'penjualan')) {
				$caption = $Language->phrase("MasterDetailEditLink");
				$url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=detailpenjualan");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			if ($GLOBALS["detailpenjualan_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'penjualan')) {
				$caption = $Language->phrase("MasterDetailCopyLink");
				$url = $this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=detailpenjualan");
				$btngrp .= "<a href=\"#\" class=\"mr-2\" title=\"" . HtmlTitle($caption) . "\" onclick=\"window.location='" . HtmlEncode($url) . "';return false;\">" . $caption . "</a>";
			}
			$btngrp .= "</div>";
			if ($link != "") {
				$btngrps .= $btngrp;
				$option->Body .= "<div class=\"d-none ew-preview\">" . $link . $btngrp . "</div>";
			}
		}

		// Hide detail items if necessary
		$this->ListOptions->hideDetailItemsForDropDown();

		// Column "preview"
		$option = $this->ListOptions["preview"];
		if (!$option) { // Add preview column
			$option = &$this->ListOptions->add("preview");
			$option->OnLeft = FALSE;
			if ($option->OnLeft) {
				$option->moveTo($this->ListOptions->itemPos("checkbox") + 1);
			} else {
				$option->moveTo($this->ListOptions->itemPos("checkbox"));
			}
			$option->Visible = !($this->isExport() || $this->isGridAdd() || $this->isGridEdit());
			$option->ShowInDropDown = FALSE;
			$option->ShowInButtonGroup = FALSE;
		}
		if ($option) {
			$option->Body = "<i class=\"ew-preview-row-btn ew-icon icon-expand\"></i>";
			$option->Body .= "<div class=\"d-none ew-preview\">" . $links . $btngrps . "</div>";
			if ($option->Visible)
				$option->Visible = $links != "";
		}

		// Column "details" (Multiple details)
		$option = $this->ListOptions["details"];
		if ($option) {
			$option->Body .= "<div class=\"d-none ew-preview\">" . $links . $btngrps . "</div>";
			if ($option->Visible)
				$option->Visible = $links != "";
		}
	}

	// Load basic search values
	protected function loadBasicSearchValues()
	{
		$this->BasicSearch->setKeyword(Get(Config("TABLE_BASIC_SEARCH"), ""), FALSE);
		if ($this->BasicSearch->Keyword != "" && $this->Command == "")
			$this->Command = "search";
		$this->BasicSearch->setType(Get(Config("TABLE_BASIC_SEARCH_TYPE"), ""), FALSE);
	}

	// Load search values for validation
	protected function loadSearchValues()
	{

		// Load search values
		$got = FALSE;

		// id
		if (!$this->isAddOrEdit() && $this->id->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->id->AdvancedSearch->SearchValue != "" || $this->id->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// kode_penjualan
		if (!$this->isAddOrEdit() && $this->kode_penjualan->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->kode_penjualan->AdvancedSearch->SearchValue != "" || $this->kode_penjualan->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// id_pelanggan
		if (!$this->isAddOrEdit() && $this->id_pelanggan->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->id_pelanggan->AdvancedSearch->SearchValue != "" || $this->id_pelanggan->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// id_member
		if (!$this->isAddOrEdit() && $this->id_member->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->id_member->AdvancedSearch->SearchValue != "" || $this->id_member->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// waktu
		if (!$this->isAddOrEdit() && $this->waktu->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->waktu->AdvancedSearch->SearchValue != "" || $this->waktu->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// diskon_persen
		if (!$this->isAddOrEdit() && $this->diskon_persen->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->diskon_persen->AdvancedSearch->SearchValue != "" || $this->diskon_persen->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// diskon_rupiah
		if (!$this->isAddOrEdit() && $this->diskon_rupiah->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->diskon_rupiah->AdvancedSearch->SearchValue != "" || $this->diskon_rupiah->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ppn
		if (!$this->isAddOrEdit() && $this->ppn->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ppn->AdvancedSearch->SearchValue != "" || $this->ppn->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// total
		if (!$this->isAddOrEdit() && $this->total->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->total->AdvancedSearch->SearchValue != "" || $this->total->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// bayar
		if (!$this->isAddOrEdit() && $this->bayar->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->bayar->AdvancedSearch->SearchValue != "" || $this->bayar->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// bayar_non_tunai
		if (!$this->isAddOrEdit() && $this->bayar_non_tunai->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->bayar_non_tunai->AdvancedSearch->SearchValue != "" || $this->bayar_non_tunai->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// total_non_tunai_charge
		if (!$this->isAddOrEdit() && $this->total_non_tunai_charge->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->total_non_tunai_charge->AdvancedSearch->SearchValue != "" || $this->total_non_tunai_charge->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// keterangan
		if (!$this->isAddOrEdit() && $this->keterangan->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->keterangan->AdvancedSearch->SearchValue != "" || $this->keterangan->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// id_klinik
		if (!$this->isAddOrEdit() && $this->id_klinik->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->id_klinik->AdvancedSearch->SearchValue != "" || $this->id_klinik->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// id_rmd
		if (!$this->isAddOrEdit() && $this->id_rmd->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->id_rmd->AdvancedSearch->SearchValue != "" || $this->id_rmd->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// metode_pembayaran
		if (!$this->isAddOrEdit() && $this->metode_pembayaran->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->metode_pembayaran->AdvancedSearch->SearchValue != "" || $this->metode_pembayaran->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// id_bank
		if (!$this->isAddOrEdit() && $this->id_bank->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->id_bank->AdvancedSearch->SearchValue != "" || $this->id_bank->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// id_kartu
		if (!$this->isAddOrEdit() && $this->id_kartu->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->id_kartu->AdvancedSearch->SearchValue != "" || $this->id_kartu->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// sales
		if (!$this->isAddOrEdit() && $this->sales->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->sales->AdvancedSearch->SearchValue != "" || $this->sales->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// dok_be_wajah
		if (!$this->isAddOrEdit() && $this->dok_be_wajah->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->dok_be_wajah->AdvancedSearch->SearchValue != "" || $this->dok_be_wajah->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// be_body
		if (!$this->isAddOrEdit() && $this->be_body->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->be_body->AdvancedSearch->SearchValue != "" || $this->be_body->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// medis
		if (!$this->isAddOrEdit() && $this->medis->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->medis->AdvancedSearch->SearchValue != "" || $this->medis->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// dokter
		if (!$this->isAddOrEdit() && $this->dokter->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->dokter->AdvancedSearch->SearchValue != "" || $this->dokter->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// id_kartubank
		if (!$this->isAddOrEdit() && $this->id_kartubank->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->id_kartubank->AdvancedSearch->SearchValue != "" || $this->id_kartubank->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// id_kas
		if (!$this->isAddOrEdit() && $this->id_kas->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->id_kas->AdvancedSearch->SearchValue != "" || $this->id_kas->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// charge
		if (!$this->isAddOrEdit() && $this->charge->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->charge->AdvancedSearch->SearchValue != "" || $this->charge->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// klaim_poin
		if (!$this->isAddOrEdit() && $this->klaim_poin->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->klaim_poin->AdvancedSearch->SearchValue != "" || $this->klaim_poin->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// total_penukaran_poin
		if (!$this->isAddOrEdit() && $this->total_penukaran_poin->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->total_penukaran_poin->AdvancedSearch->SearchValue != "" || $this->total_penukaran_poin->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// ongkir
		if (!$this->isAddOrEdit() && $this->ongkir->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->ongkir->AdvancedSearch->SearchValue != "" || $this->ongkir->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// action
		if (!$this->isAddOrEdit() && $this->_action->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->_action->AdvancedSearch->SearchValue != "" || $this->_action->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// status
		if (!$this->isAddOrEdit() && $this->status->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->status->AdvancedSearch->SearchValue != "" || $this->status->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}

		// status_void
		if (!$this->isAddOrEdit() && $this->status_void->AdvancedSearch->get()) {
			$got = TRUE;
			if (($this->status_void->AdvancedSearch->SearchValue != "" || $this->status_void->AdvancedSearch->SearchValue2 != "") && $this->Command == "")
				$this->Command = "search";
		}
		return $got;
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
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderByList())]);
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
		$this->id->setDbValue($row['id']);
		$this->kode_penjualan->setDbValue($row['kode_penjualan']);
		$this->id_pelanggan->setDbValue($row['id_pelanggan']);
		if (array_key_exists('EV__id_pelanggan', $rs->fields)) {
			$this->id_pelanggan->VirtualValue = $rs->fields('EV__id_pelanggan'); // Set up virtual field value
		} else {
			$this->id_pelanggan->VirtualValue = ""; // Clear value
		}
		$this->id_member->setDbValue($row['id_member']);
		$this->waktu->setDbValue($row['waktu']);
		$this->diskon_persen->setDbValue($row['diskon_persen']);
		$this->diskon_rupiah->setDbValue($row['diskon_rupiah']);
		$this->ppn->setDbValue($row['ppn']);
		$this->total->setDbValue($row['total']);
		$this->bayar->setDbValue($row['bayar']);
		$this->bayar_non_tunai->setDbValue($row['bayar_non_tunai']);
		$this->total_non_tunai_charge->setDbValue($row['total_non_tunai_charge']);
		$this->keterangan->setDbValue($row['keterangan']);
		$this->id_klinik->setDbValue($row['id_klinik']);
		$this->id_rmd->setDbValue($row['id_rmd']);
		$this->metode_pembayaran->setDbValue($row['metode_pembayaran']);
		$this->id_bank->setDbValue($row['id_bank']);
		$this->id_kartu->setDbValue($row['id_kartu']);
		$this->sales->setDbValue($row['sales']);
		$this->dok_be_wajah->setDbValue($row['dok_be_wajah']);
		$this->be_body->setDbValue($row['be_body']);
		$this->medis->setDbValue($row['medis']);
		$this->dokter->setDbValue($row['dokter']);
		$this->id_kartubank->setDbValue($row['id_kartubank']);
		$this->id_kas->setDbValue($row['id_kas']);
		$this->charge->setDbValue($row['charge']);
		$this->klaim_poin->setDbValue($row['klaim_poin']);
		$this->total_penukaran_poin->setDbValue($row['total_penukaran_poin']);
		$this->ongkir->setDbValue($row['ongkir']);
		$this->_action->setDbValue($row['action']);
		$this->status->setDbValue($row['status']);
		$this->status_void->setDbValue($row['status_void']);
		$this->jumlah_voucher->setDbValue($row['jumlah_voucher']);
		if (!isset($GLOBALS["detailpenjualan_grid"]))
			$GLOBALS["detailpenjualan_grid"] = new detailpenjualan_grid();
		$detailFilter = $GLOBALS["detailpenjualan"]->sqlDetailFilter_penjualan();
		$detailFilter = str_replace("@id_penjualan@", AdjustSql($this->id->DbValue, "DB"), $detailFilter);
		$GLOBALS["detailpenjualan"]->setCurrentMasterTable("penjualan");
		$detailFilter = $GLOBALS["detailpenjualan"]->applyUserIDFilters($detailFilter);
		$this->detailpenjualan_Count = $GLOBALS["detailpenjualan"]->loadRecordCount($detailFilter);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id'] = NULL;
		$row['kode_penjualan'] = NULL;
		$row['id_pelanggan'] = NULL;
		$row['id_member'] = NULL;
		$row['waktu'] = NULL;
		$row['diskon_persen'] = NULL;
		$row['diskon_rupiah'] = NULL;
		$row['ppn'] = NULL;
		$row['total'] = NULL;
		$row['bayar'] = NULL;
		$row['bayar_non_tunai'] = NULL;
		$row['total_non_tunai_charge'] = NULL;
		$row['keterangan'] = NULL;
		$row['id_klinik'] = NULL;
		$row['id_rmd'] = NULL;
		$row['metode_pembayaran'] = NULL;
		$row['id_bank'] = NULL;
		$row['id_kartu'] = NULL;
		$row['sales'] = NULL;
		$row['dok_be_wajah'] = NULL;
		$row['be_body'] = NULL;
		$row['medis'] = NULL;
		$row['dokter'] = NULL;
		$row['id_kartubank'] = NULL;
		$row['id_kas'] = NULL;
		$row['charge'] = NULL;
		$row['klaim_poin'] = NULL;
		$row['total_penukaran_poin'] = NULL;
		$row['ongkir'] = NULL;
		$row['action'] = NULL;
		$row['status'] = NULL;
		$row['status_void'] = NULL;
		$row['jumlah_voucher'] = NULL;
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
		$this->ViewUrl = $this->getViewUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->InlineEditUrl = $this->getInlineEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->InlineCopyUrl = $this->getInlineCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();

		// Convert decimal values if posted back
		if ($this->total->FormValue == $this->total->CurrentValue && is_numeric(ConvertToFloatString($this->total->CurrentValue)))
			$this->total->CurrentValue = ConvertToFloatString($this->total->CurrentValue);

		// Convert decimal values if posted back
		if ($this->bayar->FormValue == $this->bayar->CurrentValue && is_numeric(ConvertToFloatString($this->bayar->CurrentValue)))
			$this->bayar->CurrentValue = ConvertToFloatString($this->bayar->CurrentValue);

		// Convert decimal values if posted back
		if ($this->total_non_tunai_charge->FormValue == $this->total_non_tunai_charge->CurrentValue && is_numeric(ConvertToFloatString($this->total_non_tunai_charge->CurrentValue)))
			$this->total_non_tunai_charge->CurrentValue = ConvertToFloatString($this->total_non_tunai_charge->CurrentValue);

		// Convert decimal values if posted back
		if ($this->charge->FormValue == $this->charge->CurrentValue && is_numeric(ConvertToFloatString($this->charge->CurrentValue)))
			$this->charge->CurrentValue = ConvertToFloatString($this->charge->CurrentValue);

		// Convert decimal values if posted back
		if ($this->klaim_poin->FormValue == $this->klaim_poin->CurrentValue && is_numeric(ConvertToFloatString($this->klaim_poin->CurrentValue)))
			$this->klaim_poin->CurrentValue = ConvertToFloatString($this->klaim_poin->CurrentValue);

		// Convert decimal values if posted back
		if ($this->total_penukaran_poin->FormValue == $this->total_penukaran_poin->CurrentValue && is_numeric(ConvertToFloatString($this->total_penukaran_poin->CurrentValue)))
			$this->total_penukaran_poin->CurrentValue = ConvertToFloatString($this->total_penukaran_poin->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// kode_penjualan
		// id_pelanggan
		// id_member
		// waktu
		// diskon_persen
		// diskon_rupiah
		// ppn
		// total
		// bayar
		// bayar_non_tunai
		// total_non_tunai_charge
		// keterangan
		// id_klinik
		// id_rmd
		// metode_pembayaran
		// id_bank
		// id_kartu
		// sales

		$this->sales->CellCssStyle = "white-space: nowrap;";

		// dok_be_wajah
		// be_body
		// medis
		// dokter
		// id_kartubank
		// id_kas
		// charge
		// klaim_poin
		// total_penukaran_poin
		// ongkir
		// action
		// status
		// status_void
		// jumlah_voucher

		$this->jumlah_voucher->CellCssStyle = "white-space: nowrap;";
		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// kode_penjualan
			$this->kode_penjualan->ViewValue = $this->kode_penjualan->CurrentValue;
			$this->kode_penjualan->ViewCustomAttributes = "";

			// id_pelanggan
			if ($this->id_pelanggan->VirtualValue != "") {
				$this->id_pelanggan->ViewValue = $this->id_pelanggan->VirtualValue;
			} else {
				$this->id_pelanggan->ViewValue = $this->id_pelanggan->CurrentValue;
				$curVal = strval($this->id_pelanggan->CurrentValue);
				if ($curVal != "") {
					$this->id_pelanggan->ViewValue = $this->id_pelanggan->lookupCacheOption($curVal);
					if ($this->id_pelanggan->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`id_pelanggan`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->id_pelanggan->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$arwrk[2] = $rswrk->fields('df2');
							$this->id_pelanggan->ViewValue = $this->id_pelanggan->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->id_pelanggan->ViewValue = $this->id_pelanggan->CurrentValue;
						}
					}
				} else {
					$this->id_pelanggan->ViewValue = NULL;
				}
			}
			$this->id_pelanggan->ViewCustomAttributes = "";

			// id_member
			$this->id_member->ViewValue = $this->id_member->CurrentValue;
			$curVal = strval($this->id_member->CurrentValue);
			if ($curVal != "") {
				$this->id_member->ViewValue = $this->id_member->lookupCacheOption($curVal);
				if ($this->id_member->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_jenis_member`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_member->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_member->ViewValue = $this->id_member->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_member->ViewValue = $this->id_member->CurrentValue;
					}
				}
			} else {
				$this->id_member->ViewValue = NULL;
			}
			$this->id_member->ViewCustomAttributes = "";

			// waktu
			$this->waktu->ViewValue = $this->waktu->CurrentValue;
			$this->waktu->ViewValue = FormatDateTime($this->waktu->ViewValue, 7);
			$this->waktu->ViewCustomAttributes = "";

			// diskon_persen
			$this->diskon_persen->ViewValue = $this->diskon_persen->CurrentValue;
			$this->diskon_persen->ViewCustomAttributes = "";

			// diskon_rupiah
			$this->diskon_rupiah->ViewValue = $this->diskon_rupiah->CurrentValue;
			$this->diskon_rupiah->ViewValue = FormatCurrency($this->diskon_rupiah->ViewValue, 0, -2, -2, -2);
			$this->diskon_rupiah->ViewCustomAttributes = "";

			// ppn
			$this->ppn->ViewValue = $this->ppn->CurrentValue;
			$this->ppn->ViewValue = FormatNumber($this->ppn->ViewValue, 2, -2, -2, -2);
			$this->ppn->ViewCustomAttributes = "";

			// total
			$this->total->ViewValue = $this->total->CurrentValue;
			$this->total->ViewValue = FormatCurrency($this->total->ViewValue, 0, -2, -2, -2);
			$this->total->CssClass = "font-weight-bold";
			$this->total->ViewCustomAttributes = "";

			// bayar
			$this->bayar->ViewValue = $this->bayar->CurrentValue;
			$this->bayar->ViewValue = FormatCurrency($this->bayar->ViewValue, 0, -2, -2, -2);
			$this->bayar->ViewCustomAttributes = "";

			// bayar_non_tunai
			$this->bayar_non_tunai->ViewValue = $this->bayar_non_tunai->CurrentValue;
			$this->bayar_non_tunai->ViewValue = FormatNumber($this->bayar_non_tunai->ViewValue, 2, -2, -2, -2);
			$this->bayar_non_tunai->ViewCustomAttributes = "";

			// total_non_tunai_charge
			$this->total_non_tunai_charge->ViewValue = $this->total_non_tunai_charge->CurrentValue;
			$this->total_non_tunai_charge->ViewValue = FormatNumber($this->total_non_tunai_charge->ViewValue, 2, -2, -2, -2);
			$this->total_non_tunai_charge->ViewCustomAttributes = "";

			// keterangan
			$this->keterangan->ViewValue = $this->keterangan->CurrentValue;
			$this->keterangan->ViewCustomAttributes = "";

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

			// id_rmd
			$this->id_rmd->ViewValue = $this->id_rmd->CurrentValue;
			$curVal = strval($this->id_rmd->CurrentValue);
			if ($curVal != "") {
				$this->id_rmd->ViewValue = $this->id_rmd->lookupCacheOption($curVal);
				if ($this->id_rmd->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_rekmeddok`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_rmd->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_rmd->ViewValue = $this->id_rmd->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_rmd->ViewValue = $this->id_rmd->CurrentValue;
					}
				}
			} else {
				$this->id_rmd->ViewValue = NULL;
			}
			$this->id_rmd->ViewCustomAttributes = "";

			// metode_pembayaran
			if (strval($this->metode_pembayaran->CurrentValue) != "") {
				$this->metode_pembayaran->ViewValue = $this->metode_pembayaran->optionCaption($this->metode_pembayaran->CurrentValue);
			} else {
				$this->metode_pembayaran->ViewValue = NULL;
			}
			$this->metode_pembayaran->ViewCustomAttributes = "";

			// id_bank
			$curVal = strval($this->id_bank->CurrentValue);
			if ($curVal != "") {
				$this->id_bank->ViewValue = $this->id_bank->lookupCacheOption($curVal);
				if ($this->id_bank->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_rekening`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_bank->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = FormatNumber($rswrk->fields('df'), 0, -2, -2, -2);
						$arwrk[2] = $rswrk->fields('df2');
						$this->id_bank->ViewValue = $this->id_bank->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_bank->ViewValue = $this->id_bank->CurrentValue;
					}
				}
			} else {
				$this->id_bank->ViewValue = NULL;
			}
			$this->id_bank->ViewCustomAttributes = "";

			// id_kartu
			$curVal = strval($this->id_kartu->CurrentValue);
			if ($curVal != "") {
				$this->id_kartu->ViewValue = $this->id_kartu->lookupCacheOption($curVal);
				if ($this->id_kartu->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_kartu`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "`jenis` = 'Voucher'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->id_kartu->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_kartu->ViewValue = $this->id_kartu->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_kartu->ViewValue = $this->id_kartu->CurrentValue;
					}
				}
			} else {
				$this->id_kartu->ViewValue = NULL;
			}
			$this->id_kartu->ViewCustomAttributes = "";

			// sales
			$curVal = strval($this->sales->CurrentValue);
			if ($curVal != "") {
				$this->sales->ViewValue = $this->sales->lookupCacheOption($curVal);
				if ($this->sales->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_pegawai`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "`status` <> 'Non Aktif'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->sales->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = FormatNumber($rswrk->fields('df2'), 0, -2, -2, -2);
						$this->sales->ViewValue = $this->sales->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->sales->ViewValue = $this->sales->CurrentValue;
					}
				}
			} else {
				$this->sales->ViewValue = NULL;
			}
			$this->sales->ViewCustomAttributes = "";

			// dok_be_wajah
			$curVal = strval($this->dok_be_wajah->CurrentValue);
			if ($curVal != "") {
				$this->dok_be_wajah->ViewValue = $this->dok_be_wajah->lookupCacheOption($curVal);
				if ($this->dok_be_wajah->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_pegawai`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "`jabatan_pegawai` = 2 AND `status` <> 'Non Aktif'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->dok_be_wajah->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = FormatNumber($rswrk->fields('df2'), 0, -2, -2, -2);
						$this->dok_be_wajah->ViewValue = $this->dok_be_wajah->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->dok_be_wajah->ViewValue = $this->dok_be_wajah->CurrentValue;
					}
				}
			} else {
				$this->dok_be_wajah->ViewValue = NULL;
			}
			$this->dok_be_wajah->ViewCustomAttributes = "";

			// be_body
			$curVal = strval($this->be_body->CurrentValue);
			if ($curVal != "") {
				$this->be_body->ViewValue = $this->be_body->lookupCacheOption($curVal);
				if ($this->be_body->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_pegawai`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "`jabatan_pegawai` = 3 AND `status` <> 'Non Aktif'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->be_body->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = FormatNumber($rswrk->fields('df2'), 0, -2, -2, -2);
						$this->be_body->ViewValue = $this->be_body->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->be_body->ViewValue = $this->be_body->CurrentValue;
					}
				}
			} else {
				$this->be_body->ViewValue = NULL;
			}
			$this->be_body->ViewCustomAttributes = "";

			// medis
			$curVal = strval($this->medis->CurrentValue);
			if ($curVal != "") {
				$this->medis->ViewValue = $this->medis->lookupCacheOption($curVal);
				if ($this->medis->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_pegawai`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "`jabatan_pegawai` = 4 AND `status` <> 'Non Aktif'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->medis->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = FormatNumber($rswrk->fields('df2'), 0, -2, -2, -2);
						$this->medis->ViewValue = $this->medis->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->medis->ViewValue = $this->medis->CurrentValue;
					}
				}
			} else {
				$this->medis->ViewValue = NULL;
			}
			$this->medis->ViewCustomAttributes = "";

			// dokter
			$curVal = strval($this->dokter->CurrentValue);
			if ($curVal != "") {
				$this->dokter->ViewValue = $this->dokter->lookupCacheOption($curVal);
				if ($this->dokter->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_pegawai`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "`jabatan_pegawai` = 1 AND `status` <> 'Non Aktif'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->dokter->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = FormatNumber($rswrk->fields('df2'), 0, -2, -2, -2);
						$this->dokter->ViewValue = $this->dokter->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->dokter->ViewValue = $this->dokter->CurrentValue;
					}
				}
			} else {
				$this->dokter->ViewValue = NULL;
			}
			$this->dokter->ViewCustomAttributes = "";

			// id_kartubank
			$curVal = strval($this->id_kartubank->CurrentValue);
			if ($curVal != "") {
				$this->id_kartubank->ViewValue = $this->id_kartubank->lookupCacheOption($curVal);
				if ($this->id_kartubank->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_kartu`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "`jenis` <> 'Voucher'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->id_kartubank->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_kartubank->ViewValue = $this->id_kartubank->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_kartubank->ViewValue = $this->id_kartubank->CurrentValue;
					}
				}
			} else {
				$this->id_kartubank->ViewValue = NULL;
			}
			$this->id_kartubank->ViewCustomAttributes = "";

			// id_kas
			$curVal = strval($this->id_kas->CurrentValue);
			if ($curVal != "") {
				$this->id_kas->ViewValue = $this->id_kas->lookupCacheOption($curVal);
				if ($this->id_kas->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_kas->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_kas->ViewValue = $this->id_kas->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_kas->ViewValue = $this->id_kas->CurrentValue;
					}
				}
			} else {
				$this->id_kas->ViewValue = NULL;
			}
			$this->id_kas->ViewCustomAttributes = "";

			// charge
			$this->charge->ViewValue = $this->charge->CurrentValue;
			$this->charge->ViewValue = FormatNumber($this->charge->ViewValue, 2, -2, -2, -2);
			$this->charge->ViewCustomAttributes = "";

			// klaim_poin
			$this->klaim_poin->ViewValue = $this->klaim_poin->CurrentValue;
			$this->klaim_poin->ViewValue = FormatNumber($this->klaim_poin->ViewValue, 2, -2, -2, -2);
			$this->klaim_poin->ViewCustomAttributes = "";

			// total_penukaran_poin
			$this->total_penukaran_poin->ViewValue = $this->total_penukaran_poin->CurrentValue;
			$this->total_penukaran_poin->ViewValue = FormatNumber($this->total_penukaran_poin->ViewValue, 2, -2, -2, -2);
			$this->total_penukaran_poin->ViewCustomAttributes = "";

			// ongkir
			$this->ongkir->ViewValue = $this->ongkir->CurrentValue;
			$this->ongkir->ViewValue = FormatNumber($this->ongkir->ViewValue, 2, -2, -2, -2);
			$this->ongkir->ViewCustomAttributes = "";

			// action
			$this->_action->ViewValue = $this->_action->CurrentValue;
			$this->_action->ViewCustomAttributes = "";

			// status
			if (strval($this->status->CurrentValue) != "") {
				$this->status->ViewValue = $this->status->optionCaption($this->status->CurrentValue);
			} else {
				$this->status->ViewValue = NULL;
			}
			$this->status->ViewCustomAttributes = "";

			// status_void
			$this->status_void->ViewValue = $this->status_void->CurrentValue;
			$this->status_void->ViewCustomAttributes = "";

			// kode_penjualan
			$this->kode_penjualan->LinkCustomAttributes = "";
			$this->kode_penjualan->HrefValue = "";
			$this->kode_penjualan->TooltipValue = "";

			// id_pelanggan
			$this->id_pelanggan->LinkCustomAttributes = "";
			$this->id_pelanggan->HrefValue = "";
			$this->id_pelanggan->TooltipValue = "";

			// waktu
			$this->waktu->LinkCustomAttributes = "";
			$this->waktu->HrefValue = "";
			$this->waktu->TooltipValue = "";

			// total
			$this->total->LinkCustomAttributes = "";
			$this->total->HrefValue = "";
			$this->total->TooltipValue = "";

			// bayar
			$this->bayar->LinkCustomAttributes = "";
			$this->bayar->HrefValue = "";
			$this->bayar->TooltipValue = "";

			// total_non_tunai_charge
			$this->total_non_tunai_charge->LinkCustomAttributes = "";
			$this->total_non_tunai_charge->HrefValue = "";
			$this->total_non_tunai_charge->TooltipValue = "";

			// metode_pembayaran
			$this->metode_pembayaran->LinkCustomAttributes = "";
			$this->metode_pembayaran->HrefValue = "";
			$this->metode_pembayaran->TooltipValue = "";

			// id_kartubank
			$this->id_kartubank->LinkCustomAttributes = "";
			$this->id_kartubank->HrefValue = "";
			$this->id_kartubank->TooltipValue = "";

			// id_kas
			$this->id_kas->LinkCustomAttributes = "";
			$this->id_kas->HrefValue = "";
			$this->id_kas->TooltipValue = "";

			// charge
			$this->charge->LinkCustomAttributes = "";
			$this->charge->HrefValue = "";
			$this->charge->TooltipValue = "";

			// klaim_poin
			$this->klaim_poin->LinkCustomAttributes = "";
			$this->klaim_poin->HrefValue = "";
			$this->klaim_poin->TooltipValue = "";

			// total_penukaran_poin
			$this->total_penukaran_poin->LinkCustomAttributes = "";
			$this->total_penukaran_poin->HrefValue = "";
			$this->total_penukaran_poin->TooltipValue = "";

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";
			$this->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate search
	protected function validateSearch()
	{
		global $SearchError;

		// Initialize
		$SearchError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return TRUE;

		// Return validate result
		$validateSearch = ($SearchError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateSearch = $validateSearch && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($SearchError, $formCustomError);
		}
		return $validateSearch;
	}

	// Load advanced search
	public function loadAdvancedSearch()
	{
		$this->id->AdvancedSearch->load();
		$this->kode_penjualan->AdvancedSearch->load();
		$this->id_pelanggan->AdvancedSearch->load();
		$this->id_member->AdvancedSearch->load();
		$this->waktu->AdvancedSearch->load();
		$this->diskon_persen->AdvancedSearch->load();
		$this->diskon_rupiah->AdvancedSearch->load();
		$this->ppn->AdvancedSearch->load();
		$this->total->AdvancedSearch->load();
		$this->bayar->AdvancedSearch->load();
		$this->bayar_non_tunai->AdvancedSearch->load();
		$this->total_non_tunai_charge->AdvancedSearch->load();
		$this->keterangan->AdvancedSearch->load();
		$this->id_klinik->AdvancedSearch->load();
		$this->id_rmd->AdvancedSearch->load();
		$this->metode_pembayaran->AdvancedSearch->load();
		$this->id_bank->AdvancedSearch->load();
		$this->id_kartu->AdvancedSearch->load();
		$this->sales->AdvancedSearch->load();
		$this->dok_be_wajah->AdvancedSearch->load();
		$this->be_body->AdvancedSearch->load();
		$this->medis->AdvancedSearch->load();
		$this->dokter->AdvancedSearch->load();
		$this->id_kartubank->AdvancedSearch->load();
		$this->id_kas->AdvancedSearch->load();
		$this->charge->AdvancedSearch->load();
		$this->klaim_poin->AdvancedSearch->load();
		$this->total_penukaran_poin->AdvancedSearch->load();
		$this->ongkir->AdvancedSearch->load();
		$this->_action->AdvancedSearch->load();
		$this->status->AdvancedSearch->load();
		$this->status_void->AdvancedSearch->load();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fpenjualanlist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fpenjualanlist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fpenjualanlist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
			else
				return "<a href=\"" . $this->ExportPdfUrl . "\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\">" . $Language->phrase("ExportToPDF") . "</a>";
		} elseif (SameText($type, "html")) {
			return "<a href=\"" . $this->ExportHtmlUrl . "\" class=\"ew-export-link ew-html\" title=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\">" . $Language->phrase("ExportToHtml") . "</a>";
		} elseif (SameText($type, "xml")) {
			return "<a href=\"" . $this->ExportXmlUrl . "\" class=\"ew-export-link ew-xml\" title=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\">" . $Language->phrase("ExportToXml") . "</a>";
		} elseif (SameText($type, "csv")) {
			return "<a href=\"" . $this->ExportCsvUrl . "\" class=\"ew-export-link ew-csv\" title=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\">" . $Language->phrase("ExportToCsv") . "</a>";
		} elseif (SameText($type, "email")) {
			$url = $custom ? ",url:'" . $this->pageUrl() . "export=email&amp;custom=1'" : "";
			return '<button id="emf_penjualan" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_penjualan\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fpenjualanlist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
		} elseif (SameText($type, "print")) {
			return "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ew-export-link ew-print\" title=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\">" . $Language->phrase("PrinterFriendly") . "</a>";
		}
	}

	// Set up export options
	protected function setupExportOptions()
	{
		global $Language;

		// Printer friendly
		$item = &$this->ExportOptions->add("print");
		$item->Body = $this->getExportTag("print");
		$item->Visible = TRUE;

		// Export to Excel
		$item = &$this->ExportOptions->add("excel");
		$item->Body = $this->getExportTag("excel");
		$item->Visible = TRUE;

		// Export to Word
		$item = &$this->ExportOptions->add("word");
		$item->Body = $this->getExportTag("word");
		$item->Visible = TRUE;

		// Export to Html
		$item = &$this->ExportOptions->add("html");
		$item->Body = $this->getExportTag("html");
		$item->Visible = TRUE;

		// Export to Xml
		$item = &$this->ExportOptions->add("xml");
		$item->Body = $this->getExportTag("xml");
		$item->Visible = TRUE;

		// Export to Csv
		$item = &$this->ExportOptions->add("csv");
		$item->Body = $this->getExportTag("csv");
		$item->Visible = TRUE;

		// Export to Pdf
		$item = &$this->ExportOptions->add("pdf");
		$item->Body = $this->getExportTag("pdf");
		$item->Visible = TRUE;

		// Export to Email
		$item = &$this->ExportOptions->add("email");
		$item->Body = $this->getExportTag("email");
		$item->Visible = FALSE;

		// Drop down button for export
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseDropDownButton = FALSE;
		if ($this->ExportOptions->UseButtonGroup && IsMobile())
			$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->DropDownButtonPhrase = $Language->phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Set up search options
	protected function setupSearchOptions()
	{
		global $Language;
		$this->SearchOptions = new ListOptions("div");
		$this->SearchOptions->TagClassName = "ew-search-option";

		// Search button
		$item = &$this->SearchOptions->add("searchtoggle");
		$searchToggleClass = ($this->SearchWhere != "") ? " active" : " active";
		$item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fpenjualanlistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->add("showall");
		$item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $this->pageUrl() . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

		// Advanced search button
		$item = &$this->SearchOptions->add("advancedsearch");
		if (IsMobile())
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"penjualansrch.php\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		else
			$item->Body = "<a class=\"btn btn-default ew-advanced-search\" title=\"" . $Language->phrase("AdvancedSearch") . "\" data-table=\"penjualan\" data-caption=\"" . $Language->phrase("AdvancedSearch") . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'SearchBtn',url:'penjualansrch.php'});\">" . $Language->phrase("AdvancedSearchBtn") . "</a>";
		$item->Visible = TRUE;

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->isExport() || $this->CurrentAction)
			$this->SearchOptions->hideAllOptions();
		global $Security;
		if (!$Security->canSearch()) {
			$this->SearchOptions->hideAllOptions();
			$this->FilterOptions->hideAllOptions();
		}
	}

	/**
	 * Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	 *
	 * @param boolean $return Return the data rather than output it
	 * @return mixed
	 */
	public function exportData($return = FALSE)
	{
		global $Language;
		$utf8 = SameText(Config("PROJECT_CHARSET"), "utf-8");
		$selectLimit = $this->UseSelectLimit;

		// Load recordset
		if ($selectLimit) {
			$this->TotalRecords = $this->listRecordCount();
		} else {
			if (!$this->Recordset)
				$this->Recordset = $this->loadRecordset();
			$rs = &$this->Recordset;
			if ($rs)
				$this->TotalRecords = $rs->RecordCount();
		}
		$this->StartRecord = 1;

		// Export all
		if ($this->ExportAll) {
			set_time_limit(Config("EXPORT_ALL_TIME_LIMIT"));
			$this->DisplayRecords = $this->TotalRecords;
			$this->StopRecord = $this->TotalRecords;
		} else { // Export one page only
			$this->setupStartRecord(); // Set up start record position

			// Set the last record to display
			if ($this->DisplayRecords <= 0) {
				$this->StopRecord = $this->TotalRecords;
			} else {
				$this->StopRecord = $this->StartRecord + $this->DisplayRecords - 1;
			}
		}
		if ($selectLimit)
			$rs = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords <= 0 ? $this->TotalRecords : $this->DisplayRecords);
		$this->ExportDoc = GetExportDocument($this, "h");
		$doc = &$this->ExportDoc;
		if (!$doc)
			$this->setFailureMessage($Language->phrase("ExportClassNotFound")); // Export class not found
		if (!$rs || !$doc) {
			RemoveHeader("Content-Type"); // Remove header
			RemoveHeader("Content-Disposition");
			$this->showMessage();
			return;
		}
		if ($selectLimit) {
			$this->StartRecord = 1;
			$this->StopRecord = $this->DisplayRecords <= 0 ? $this->TotalRecords : $this->DisplayRecords;
		}

		// Call Page Exporting server event
		$this->ExportDoc->ExportCustom = !$this->Page_Exporting();
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		$doc->Text .= $header;
		$this->exportDocument($doc, $rs, $this->StartRecord, $this->StopRecord, "");
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		$doc->Text .= $footer;

		// Close recordset
		$rs->close();

		// Call Page Exported server event
		$this->Page_Exported();

		// Export header and footer
		$doc->exportHeaderAndFooter();

		// Clean output buffer (without destroying output buffer)
		$buffer = ob_get_contents(); // Save the output buffer
		if (!Config("DEBUG") && $buffer)
			ob_clean();

		// Write debug message if enabled
		if (Config("DEBUG") && !$this->isExport("pdf"))
			echo GetDebugMessage();

		// Output data
		if ($this->isExport("email")) {

			// Export-to-email disabled
		} else {
			$doc->export();
			if ($return) {
				RemoveHeader("Content-Type"); // Remove header
				RemoveHeader("Content-Disposition");
				$content = ob_get_contents();
				if ($content)
					ob_clean();
				if ($buffer)
					echo $buffer; // Resume the output buffer
				return $content;
			}
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
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
				case "x_id_pelanggan":
					break;
				case "x_id_member":
					break;
				case "x_id_klinik":
					break;
				case "x_id_rmd":
					break;
				case "x_metode_pembayaran":
					break;
				case "x_id_bank":
					break;
				case "x_id_kartu":
					$lookupFilter = function() {
						return "`jenis` = 'Voucher'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_sales":
					$lookupFilter = function() {
						return "`status` <> 'Non Aktif'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_dok_be_wajah":
					$lookupFilter = function() {
						return "`jabatan_pegawai` = 2 AND `status` <> 'Non Aktif'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_be_body":
					$lookupFilter = function() {
						return "`jabatan_pegawai` = 3 AND `status` <> 'Non Aktif'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_medis":
					$lookupFilter = function() {
						return "`jabatan_pegawai` = 4 AND `status` <> 'Non Aktif'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_dokter":
					$lookupFilter = function() {
						return "`jabatan_pegawai` = 1 AND `status` <> 'Non Aktif'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_id_kartubank":
					$lookupFilter = function() {
						return "`jenis` <> 'Voucher'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_id_kas":
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
						case "x_id_pelanggan":
							break;
						case "x_id_member":
							break;
						case "x_id_klinik":
							break;
						case "x_id_rmd":
							break;
						case "x_id_bank":
							$row[1] = FormatNumber($row[1], 0, -2, -2, -2);
							$row['df'] = $row[1];
							break;
						case "x_id_kartu":
							break;
						case "x_sales":
							$row[2] = FormatNumber($row[2], 0, -2, -2, -2);
							$row['df2'] = $row[2];
							break;
						case "x_dok_be_wajah":
							$row[2] = FormatNumber($row[2], 0, -2, -2, -2);
							$row['df2'] = $row[2];
							break;
						case "x_be_body":
							$row[2] = FormatNumber($row[2], 0, -2, -2, -2);
							$row['df2'] = $row[2];
							break;
						case "x_medis":
							$row[2] = FormatNumber($row[2], 0, -2, -2, -2);
							$row['df2'] = $row[2];
							break;
						case "x_dokter":
							$row[2] = FormatNumber($row[2], 0, -2, -2, -2);
							$row['df2'] = $row[2];
							break;
						case "x_id_kartubank":
							break;
						case "x_id_kas":
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
			$type = null;
			$msg = null;
			$_SESSION['EW_SESSION_FAILURE_MESSAGE'] = "";
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

		$this->ListOptions->Add("print"); // Replace abclink with your name of the link
		$this->ListOptions->Items["print"]->Header = "";
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

		$status =  CurrentTable()->status->CurrentValue;
		if($status == 'Printed'){
			$this->ListOptions->Items["print"]->Body = "<a href='./struk_belanja.php?id=".CurrentTable()->id->CurrentValue."'><button type='button' class='btn btn-outline-info btn-sm'><i class='fas fa-receipt'></i> Struk</button></a>";	
			$this->ListOptions->Items["edit"]->Body = "";
		} else if($status == 'Draft'){
			$this->ListOptions->Items["print"]->Body = "";		
		}
	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}

	// Page Importing event
	function Page_Importing($reader, &$options) {

		//var_dump($reader); // Import data reader
		//var_dump($options); // Show all options for importing
		//return FALSE; // Return FALSE to skip import

		return TRUE;
	}

	// Row Import event
	function Row_Import(&$row, $cnt) {

		//echo $cnt; // Import record count
		//var_dump($row); // Import row
		//return FALSE; // Return FALSE to skip import

		return TRUE;
	}

	// Page Imported event
	function Page_Imported($reader, $results) {

		//var_dump($reader); // Import data reader
		//var_dump($results); // Import results

	}
} // End class
?>