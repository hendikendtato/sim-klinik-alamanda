<?php
namespace PHPMaker2020\klinik_latest_08_04_21;

/**
 * Page class
 */
class report_rekap_summary extends report_rekap
{

	// Page ID
	public $PageID = "summary";

	// Project ID
	public $ProjectID = "{4E2A1FD4-0074-4494-903F-430527A228F4}";

	// Table name
	public $TableName = 'report_rekap';

	// Page object name
	public $PageObjName = "report_rekap_summary";

	// CSS
	public $ReportTableClass = "";
	public $ReportTableStyle = "";

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

		// Table object (report_rekap)
		if (!isset($GLOBALS["report_rekap"]) || get_class($GLOBALS["report_rekap"]) == PROJECT_NAMESPACE . "report_rekap") {
			$GLOBALS["report_rekap"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["report_rekap"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->pageUrl() . "export=print";
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel";
		$this->ExportWordUrl = $this->pageUrl() . "export=word";
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf";

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'summary');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'report_rekap');

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

		// Export options
		$this->ExportOptions = new ListOptions("div");
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Filter options
		$this->FilterOptions = new ListOptions("div");
		$this->FilterOptions->TagClassName = "ew-filter-option fsummary";
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
		if ($this->isExport() && !$this->isExport("print") && $fn = Config("REPORT_EXPORT_FUNCTIONS." . $this->Export)) {
			$content = ob_get_clean();
			$this->$fn($content);
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection if not in dashboard
		if (!$DashboardReport)
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

		// Exit if not in dashboard
		if (!$DashboardReport)
			exit();
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
		if (in_array($lookup->LinkTable, [$this->ReportSourceTable, $this->TableVar]))
			$lookup->RenderViewFunc = "renderLookup"; // Set up view renderer
		$lookup->RenderEditFunc = ""; // Set up edit renderer

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

	// Initialize common variables
	public $HideOptions = FALSE;
	public $ExportOptions; // Export options
	public $SearchOptions; // Search options
	public $FilterOptions; // Filter options

	// Records
	public $GroupRecords = [];
	public $DetailRecords = [];
	public $DetailRecordCount = 0;

	// Paging variables
	public $RecordIndex = 0; // Record index
	public $RecordCount = 0; // Record count (start from 1 for each group)
	public $StartGroup = 0; // Start group
	public $StopGroup = 0; // Stop group
	public $TotalGroups = 0; // Total groups
	public $GroupCount = 0; // Group count
	public $GroupCounter = []; // Group counter
	public $DisplayGroups = 3; // Groups per page
	public $GroupRange = 10;
	public $PageSizes = "1,2,3,5,-1"; // Page sizes (comma separated)
	public $Sort = "";
	public $Filter = "";
	public $PageFirstGroupFilter = "";
	public $UserIDFilter = "";
	public $DefaultSearchWhere = ""; // Default search WHERE clause
	public $SearchWhere = "";
	public $SearchPanelClass = "ew-search-panel collapse show"; // Search Panel class
	public $SearchRowCount = 0; // For extended search
	public $SearchColumnCount = 0; // For extended search
	public $SearchFieldsPerRow = 1; // For extended search
	public $DrillDownList = "";
	public $DbMasterFilter = ""; // Master filter
	public $DbDetailFilter = ""; // Detail filter
	public $SearchCommand = FALSE;
	public $ShowHeader;
	public $GroupColumnCount = 0;
	public $SubGroupColumnCount = 0;
	public $DetailColumnCount = 0;
	public $TotalCount;
	public $PageTotalCount;
	public $TopContentClass = "col-sm-12 ew-top";
	public $LeftContentClass = "col-sm-6 ew-left";
	public $CenterContentClass = "col-sm-6 ew-center";
	public $RightContentClass = "ew-right";
	public $BottomContentClass = "col-sm-12 ew-bottom";

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $ExportFileName, $Language, $Security, $UserProfile,
			$Security, $FormError, $DrillDownInPanel, $Breadcrumb,
			$DashboardReport, $CustomExportType, $ReportExportType;

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
			if (!$Security->canReport()) {
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
		}
		$ExportFileName = $this->TableVar; // Get export file, used in header

		// Get custom export parameters
		if ($this->isExport() && $custom != "") {
			$this->CustomExport = $this->Export;
			$this->Export = "print";
		}
		$CustomExportType = $this->CustomExport;
		$ExportType = $this->Export; // Get export parameter, used in header
		$ReportExportType = $ExportType; // Report export type, used in header

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

		// Setup export options
		$this->setupExportOptions();

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

		// Set up table class
		if ($this->isExport("word") || $this->isExport("excel") || $this->isExport("pdf"))
			$this->ReportTableClass = "ew-table";
		else
			$this->ReportTableClass = "table ew-table";

		// Set field visibility for detail fields
		$this->id_klinik->setVisibility();
		$this->tanggal->setVisibility();
		$this->stok_awal->setVisibility();
		$this->masuk->setVisibility();
		$this->keluar->setVisibility();
		$this->retur->setVisibility();
		$this->stok_akhir->setVisibility();
		$this->id_penyesuaian->setVisibility();
		$this->id_nonjual->setVisibility();
		$this->keluar_nonjual->setVisibility();
		$this->masuk_penyesuaian->setVisibility();
		$this->keluar_penyesuaian->setVisibility();
		$this->id_kirimbarang->setVisibility();
		$this->keluar_kirim->setVisibility();
		$this->id_terimagudang->setVisibility();

		// Set up groups per page dynamically
		$this->setupDisplayGroups();

		// Set up Breadcrumb
		if (!$this->isExport())
			$this->setupBreadcrumb();

		// Load custom filters
		$this->Page_FilterLoad();

		// Extended filter
		$extendedFilter = "";

		// No filter
		$this->FilterOptions["savecurrentfilter"]->Visible = FALSE;
		$this->FilterOptions["deletefilter"]->Visible = FALSE;

		// Call Page Selecting event
		$this->Page_Selecting($this->SearchWhere);

		// Search options
		$this->setupSearchOptions();

		// Set up search panel class
		if ($this->SearchWhere != "")
			AppendClass($this->SearchPanelClass, "show");

		// Get sort
		$this->Sort = $this->getSort();

		// Update filter
		AddFilter($this->Filter, $this->SearchWhere);

		// Get total group count
		$sql = BuildReportSql($this->getSqlSelectGroup(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
		$this->TotalGroups = $this->getRecordCount($sql);
		if ($this->DisplayGroups <= 0 || $this->DrillDown || $DashboardReport) // Display all groups
			$this->DisplayGroups = $this->TotalGroups;
		$this->StartGroup = 1;

		// Show header
		$this->ShowHeader = ($this->TotalGroups > 0);

		// Set up start position if not export all
		if ($this->ExportAll && $this->isExport())
			$this->DisplayGroups = $this->TotalGroups;
		else
			$this->setupStartGroup();

		// Set no record found message
		if ($this->TotalGroups == 0) {
			if ($Security->canList()) {
				if ($this->SearchWhere == "0=101") {
					$this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
				} else {
					$this->setWarningMessage($Language->phrase("NoRecord"));
				}
			} else {
				$this->setWarningMessage(DeniedMessage());
			}
		}

		// Hide export options if export/dashboard report/hide options
		if ($this->isExport() || $DashboardReport || $this->HideOptions)
			$this->ExportOptions->hideAllOptions();

		// Hide search/filter options if export/drilldown/dashboard report/hide options
		if ($this->isExport() || $this->DrillDown || $DashboardReport || $this->HideOptions) {
			$this->SearchOptions->hideAllOptions();
			$this->FilterOptions->hideAllOptions();
		}

		// Get group records
		if ($this->TotalGroups > 0) {
			$grpSort = UpdateSortFields($this->getSqlOrderByGroup(), $this->Sort, 2); // Get grouping field only
			$sql = BuildReportSql($this->getSqlSelectGroup(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderByGroup(), $this->Filter, $grpSort);
			$grpRs = $this->getRecordset($sql, $this->DisplayGroups, $this->StartGroup - 1);
			$this->GroupRecords = $grpRs->getRows(); // Get records of first grouping field
			$this->loadGroupRowValues();
			$this->GroupCount = 1;
		}

		// Init detail records
		$this->DetailRecords = [];
		$this->setupFieldCount();

		// Set the last group to display if not export all
		if ($this->ExportAll && $this->isExport()) {
			$this->StopGroup = $this->TotalGroups;
		} else {
			$this->StopGroup = $this->StartGroup + $this->DisplayGroups - 1;
		}

		// Stop group <= total number of groups
		if (intval($this->StopGroup) > intval($this->TotalGroups))
			$this->StopGroup = $this->TotalGroups;
		$this->RecordCount = 0;
		$this->RecordIndex = 0;

		// Set up pager
		$this->Pager = new PrevNextPager($this->StartGroup, $this->DisplayGroups, $this->TotalGroups, $this->PageSizes, $this->GroupRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);
	}

	// Load group row values
	public function loadGroupRowValues()
	{
		$cnt = count($this->GroupRecords); // Get record count
		if ($this->GroupCount < $cnt)
			$this->id_barang->setGroupValue($this->GroupRecords[$this->GroupCount][0]);
		else
			$this->id_barang->setGroupValue("");
	}

	// Load row values
	public function loadRowValues($record)
	{
		if ($this->RecordIndex == 1) { // Load first row data
			$data = [];
			$data["id_kartustok"] = $record['id_kartustok'];
			$data["id_barang"] = $record['id_barang'];
			$data["id_klinik"] = $record['id_klinik'];
			$data["tanggal"] = $record['tanggal'];
			$data["id_terimabarang"] = $record['id_terimabarang'];
			$data["id_penjualan"] = $record['id_penjualan'];
			$data["id_retur"] = $record['id_retur'];
			$data["stok_awal"] = $record['stok_awal'];
			$data["masuk"] = $record['masuk'];
			$data["keluar"] = $record['keluar'];
			$data["retur"] = $record['retur'];
			$data["stok_akhir"] = $record['stok_akhir'];
			$data["id_penyesuaian"] = $record['id_penyesuaian'];
			$data["id_nonjual"] = $record['id_nonjual'];
			$data["keluar_nonjual"] = $record['keluar_nonjual'];
			$data["masuk_penyesuaian"] = $record['masuk_penyesuaian'];
			$data["keluar_penyesuaian"] = $record['keluar_penyesuaian'];
			$data["id_kirimbarang"] = $record['id_kirimbarang'];
			$data["keluar_kirim"] = $record['keluar_kirim'];
			$data["id_terimagudang"] = $record['id_terimagudang'];
			$this->Rows[] = $data;
		}
		$this->id_kartustok->setDbValue($record['id_kartustok']);
		$this->id_barang->setDbValue(GroupValue($this->id_barang, $record['id_barang']));
		$this->id_klinik->setDbValue($record['id_klinik']);
		$this->tanggal->setDbValue($record['tanggal']);
		$this->id_terimabarang->setDbValue($record['id_terimabarang']);
		$this->id_penjualan->setDbValue($record['id_penjualan']);
		$this->id_retur->setDbValue($record['id_retur']);
		$this->stok_awal->setDbValue($record['stok_awal']);
		$this->masuk->setDbValue($record['masuk']);
		$this->keluar->setDbValue($record['keluar']);
		$this->retur->setDbValue($record['retur']);
		$this->stok_akhir->setDbValue($record['stok_akhir']);
		$this->id_penyesuaian->setDbValue($record['id_penyesuaian']);
		$this->id_nonjual->setDbValue($record['id_nonjual']);
		$this->keluar_nonjual->setDbValue($record['keluar_nonjual']);
		$this->masuk_penyesuaian->setDbValue($record['masuk_penyesuaian']);
		$this->keluar_penyesuaian->setDbValue($record['keluar_penyesuaian']);
		$this->id_kirimbarang->setDbValue($record['id_kirimbarang']);
		$this->keluar_kirim->setDbValue($record['keluar_kirim']);
		$this->id_terimagudang->setDbValue($record['id_terimagudang']);
	}

	// Render row
	public function renderRow()
	{
		global $Security, $Language, $Language;
		$conn = $this->getConnection();
		if ($this->RowType == ROWTYPE_TOTAL && $this->RowTotalSubType == ROWTOTAL_FOOTER && $this->RowTotalType == ROWTOTAL_PAGE) { // Get Page total

			// Build detail SQL
			$firstGrpFld = &$this->id_barang;
			$firstGrpFld->getDistinctValues($this->GroupRecords);
			$where = DetailFilterSql($firstGrpFld, $this->getSqlFirstGroupField(), $firstGrpFld->DistinctValues, $this->Dbid);
			if ($this->Filter != "")
				$where = "($this->Filter) AND ($where)";
			$sql = BuildReportSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(), $where, $this->Sort);
			$rs = $this->getRecordset($sql);
			$records = $rs ? $rs->getRows() : [];
			$this->stok_awal->getSum($records);
			$this->masuk->getSum($records);
			$this->keluar->getSum($records);
			$this->retur->getSum($records);
			$this->stok_akhir->getSum($records);
			$this->PageTotalCount = count($records);
		} elseif ($this->RowType == ROWTYPE_TOTAL && $this->RowTotalSubType == ROWTOTAL_FOOTER && $this->RowTotalType == ROWTOTAL_GRAND) { // Get Grand total
			$hasCount = FALSE;
			$hasSummary = FALSE;

			// Get total count from SQL directly
			$sql = BuildReportSql($this->getSqlSelectCount(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
			$rstot = $conn->execute($sql);
			if ($rstot) {
				$cnt = ($rstot->recordCount() > 1) ? $rstot->recordCount() : $rstot->fields[0];
				$rstot->close();
				$hasCount = TRUE;
			} else {
				$cnt = 0;
			}
			$this->TotalCount = $cnt;

			// Get total from SQL directly
			$sql = BuildReportSql($this->getSqlSelectAggregate(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
			$sql = $this->getSqlAggregatePrefix() . $sql . $this->getSqlAggregateSuffix();
			$rsagg = $conn->execute($sql);
			if ($rsagg) {
				$this->id_klinik->Count = $this->TotalCount;
				$this->tanggal->Count = $this->TotalCount;
				$this->stok_awal->Count = $this->TotalCount;
				$this->stok_awal->SumValue = $rsagg->fields("sum_stok_awal");
				$this->masuk->Count = $this->TotalCount;
				$this->masuk->SumValue = $rsagg->fields("sum_masuk");
				$this->keluar->Count = $this->TotalCount;
				$this->keluar->SumValue = $rsagg->fields("sum_keluar");
				$this->retur->Count = $this->TotalCount;
				$this->retur->SumValue = $rsagg->fields("sum_retur");
				$this->stok_akhir->Count = $this->TotalCount;
				$this->stok_akhir->SumValue = $rsagg->fields("sum_stok_akhir");
				$this->id_penyesuaian->Count = $this->TotalCount;
				$this->id_nonjual->Count = $this->TotalCount;
				$this->keluar_nonjual->Count = $this->TotalCount;
				$this->masuk_penyesuaian->Count = $this->TotalCount;
				$this->keluar_penyesuaian->Count = $this->TotalCount;
				$this->id_kirimbarang->Count = $this->TotalCount;
				$this->keluar_kirim->Count = $this->TotalCount;
				$this->id_terimagudang->Count = $this->TotalCount;
				$rsagg->close();
				$hasSummary = TRUE;
			}

			// Accumulate grand summary from detail records
			if (!$hasCount || !$hasSummary) {
				$sql = BuildReportSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(), $this->getSqlHaving(), "", $this->Filter, "");
				$rs = $this->getRecordset($sql);
				$this->DetailRecords = $rs ? $rs->getRows() : [];
			$this->stok_awal->getSum($this->DetailRecords);
			$this->masuk->getSum($this->DetailRecords);
			$this->keluar->getSum($this->DetailRecords);
			$this->retur->getSum($this->DetailRecords);
			$this->stok_akhir->getSum($this->DetailRecords);
			}
		}

		// Call Row_Rendering event
		$this->Row_Rendering();

		// id_barang
		// id_klinik
		// tanggal
		// stok_awal
		// masuk
		// keluar
		// retur
		// stok_akhir
		// id_penyesuaian
		// id_nonjual
		// keluar_nonjual
		// masuk_penyesuaian
		// keluar_penyesuaian
		// id_kirimbarang
		// keluar_kirim
		// id_terimagudang

		if ($this->RowType == ROWTYPE_SEARCH) { // Search row
		} elseif ($this->RowType == ROWTYPE_TOTAL && !($this->RowTotalType == ROWTOTAL_GROUP && $this->RowTotalSubType == ROWTOTAL_HEADER)) { // Summary row
			$this->RowAttrs->prependClass(($this->RowTotalType == ROWTOTAL_PAGE || $this->RowTotalType == ROWTOTAL_GRAND) ? "ew-rpt-grp-aggregate" : ""); // Set up row class
			if ($this->RowTotalType == ROWTOTAL_GROUP)
				$this->RowAttrs["data-group"] = $this->id_barang->groupValue(); // Set up group attribute

			// id_barang
			$curVal = strval($this->id_barang->groupValue());
			if ($curVal != "") {
				$this->id_barang->GroupViewValue = $this->id_barang->lookupCacheOption($curVal);
				if ($this->id_barang->GroupViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_barang->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_barang->GroupViewValue = $this->id_barang->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_barang->GroupViewValue = $this->id_barang->groupValue();
					}
				}
			} else {
				$this->id_barang->GroupViewValue = NULL;
			}
			$this->id_barang->CellCssClass = ($this->RowGroupLevel == 1 ? "ew-rpt-grp-summary-1" : "ew-rpt-grp-field-1");
			$this->id_barang->ViewCustomAttributes = "";
			$this->id_barang->GroupViewValue = DisplayGroupValue($this->id_barang, $this->id_barang->GroupViewValue);
			if (!$this->id_barang->LevelBreak) {
			 	if ($this->id_barang->ShowCompactSummaryFooter)
					$this->id_barang->GroupViewValue = "&nbsp;";
			} else
				$this->id_barang->LevelBreak = false;

			// stok_awal
			$this->stok_awal->SumViewValue = $this->stok_awal->SumValue;
			$this->stok_awal->SumViewValue = FormatNumber($this->stok_awal->SumViewValue, 2, -2, -2, -2);
			$this->stok_awal->ViewCustomAttributes = "";
			$this->stok_awal->CellAttrs["class"] = ($this->RowTotalType == ROWTOTAL_PAGE || $this->RowTotalType == ROWTOTAL_GRAND) ? "ew-rpt-grp-aggregate" : "ew-rpt-grp-summary-" . $this->RowGroupLevel;

			// masuk
			$this->masuk->SumViewValue = $this->masuk->SumValue;
			$this->masuk->SumViewValue = FormatNumber($this->masuk->SumViewValue, 2, -2, -2, -2);
			$this->masuk->ViewCustomAttributes = "";
			$this->masuk->CellAttrs["class"] = ($this->RowTotalType == ROWTOTAL_PAGE || $this->RowTotalType == ROWTOTAL_GRAND) ? "ew-rpt-grp-aggregate" : "ew-rpt-grp-summary-" . $this->RowGroupLevel;

			// keluar
			$this->keluar->SumViewValue = $this->keluar->SumValue;
			$this->keluar->SumViewValue = FormatNumber($this->keluar->SumViewValue, 2, -2, -2, -2);
			$this->keluar->ViewCustomAttributes = "";
			$this->keluar->CellAttrs["class"] = ($this->RowTotalType == ROWTOTAL_PAGE || $this->RowTotalType == ROWTOTAL_GRAND) ? "ew-rpt-grp-aggregate" : "ew-rpt-grp-summary-" . $this->RowGroupLevel;

			// retur
			$this->retur->SumViewValue = $this->retur->SumValue;
			$this->retur->SumViewValue = FormatNumber($this->retur->SumViewValue, 2, -2, -2, -2);
			$this->retur->ViewCustomAttributes = "";
			$this->retur->CellAttrs["class"] = ($this->RowTotalType == ROWTOTAL_PAGE || $this->RowTotalType == ROWTOTAL_GRAND) ? "ew-rpt-grp-aggregate" : "ew-rpt-grp-summary-" . $this->RowGroupLevel;

			// stok_akhir
			$this->stok_akhir->SumViewValue = $this->stok_akhir->SumValue;
			$this->stok_akhir->SumViewValue = FormatNumber($this->stok_akhir->SumViewValue, 2, -2, -2, -2);
			$this->stok_akhir->ViewCustomAttributes = "";
			$this->stok_akhir->CellAttrs["class"] = ($this->RowTotalType == ROWTOTAL_PAGE || $this->RowTotalType == ROWTOTAL_GRAND) ? "ew-rpt-grp-aggregate" : "ew-rpt-grp-summary-" . $this->RowGroupLevel;

			// id_barang
			$this->id_barang->HrefValue = "";

			// id_klinik
			$this->id_klinik->HrefValue = "";

			// tanggal
			$this->tanggal->HrefValue = "";

			// stok_awal
			$this->stok_awal->HrefValue = "";

			// masuk
			$this->masuk->HrefValue = "";

			// keluar
			$this->keluar->HrefValue = "";

			// retur
			$this->retur->HrefValue = "";

			// stok_akhir
			$this->stok_akhir->HrefValue = "";

			// id_penyesuaian
			$this->id_penyesuaian->HrefValue = "";

			// id_nonjual
			$this->id_nonjual->HrefValue = "";

			// keluar_nonjual
			$this->keluar_nonjual->HrefValue = "";

			// masuk_penyesuaian
			$this->masuk_penyesuaian->HrefValue = "";

			// keluar_penyesuaian
			$this->keluar_penyesuaian->HrefValue = "";

			// id_kirimbarang
			$this->id_kirimbarang->HrefValue = "";

			// keluar_kirim
			$this->keluar_kirim->HrefValue = "";

			// id_terimagudang
			$this->id_terimagudang->HrefValue = "";
		} else {
			if ($this->RowTotalType == ROWTOTAL_GROUP && $this->RowTotalSubType == ROWTOTAL_HEADER) {
			$this->RowAttrs["data-group"] = $this->id_barang->groupValue(); // Set up group attribute
			} else {
			$this->RowAttrs["data-group"] = $this->id_barang->groupValue(); // Set up group attribute
			}

			// id_barang
			$curVal = strval($this->id_barang->groupValue());
			if ($curVal != "") {
				$this->id_barang->GroupViewValue = $this->id_barang->lookupCacheOption($curVal);
				if ($this->id_barang->GroupViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_barang->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_barang->GroupViewValue = $this->id_barang->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_barang->GroupViewValue = $this->id_barang->groupValue();
					}
				}
			} else {
				$this->id_barang->GroupViewValue = NULL;
			}
			$this->id_barang->CellCssClass = "ew-rpt-grp-field-1";
			$this->id_barang->ViewCustomAttributes = "";
			$this->id_barang->GroupViewValue = DisplayGroupValue($this->id_barang, $this->id_barang->GroupViewValue);
			if (!$this->id_barang->LevelBreak)
				$this->id_barang->GroupViewValue = "&nbsp;";
			else
				$this->id_barang->LevelBreak = FALSE;

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
			$this->id_klinik->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->id_klinik->ViewCustomAttributes = "";

			// tanggal
			$this->tanggal->ViewValue = $this->tanggal->CurrentValue;
			$this->tanggal->ViewValue = FormatDateTime($this->tanggal->ViewValue, 0);
			$this->tanggal->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->tanggal->ViewCustomAttributes = "";

			// stok_awal
			$this->stok_awal->ViewValue = $this->stok_awal->CurrentValue;
			$this->stok_awal->ViewValue = FormatNumber($this->stok_awal->ViewValue, 2, -2, -2, -2);
			$this->stok_awal->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->stok_awal->ViewCustomAttributes = "";

			// masuk
			$this->masuk->ViewValue = $this->masuk->CurrentValue;
			$this->masuk->ViewValue = FormatNumber($this->masuk->ViewValue, 2, -2, -2, -2);
			$this->masuk->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->masuk->ViewCustomAttributes = "";

			// keluar
			$this->keluar->ViewValue = $this->keluar->CurrentValue;
			$this->keluar->ViewValue = FormatNumber($this->keluar->ViewValue, 2, -2, -2, -2);
			$this->keluar->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->keluar->ViewCustomAttributes = "";

			// retur
			$this->retur->ViewValue = $this->retur->CurrentValue;
			$this->retur->ViewValue = FormatNumber($this->retur->ViewValue, 2, -2, -2, -2);
			$this->retur->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->retur->ViewCustomAttributes = "";

			// stok_akhir
			$this->stok_akhir->ViewValue = $this->stok_akhir->CurrentValue;
			$this->stok_akhir->ViewValue = FormatNumber($this->stok_akhir->ViewValue, 2, -2, -2, -2);
			$this->stok_akhir->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->stok_akhir->ViewCustomAttributes = "";

			// id_penyesuaian
			$this->id_penyesuaian->ViewValue = $this->id_penyesuaian->CurrentValue;
			$this->id_penyesuaian->ViewValue = FormatNumber($this->id_penyesuaian->ViewValue, 0, -2, -2, -2);
			$this->id_penyesuaian->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->id_penyesuaian->ViewCustomAttributes = "";

			// id_nonjual
			$this->id_nonjual->ViewValue = $this->id_nonjual->CurrentValue;
			$this->id_nonjual->ViewValue = FormatNumber($this->id_nonjual->ViewValue, 0, -2, -2, -2);
			$this->id_nonjual->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->id_nonjual->ViewCustomAttributes = "";

			// keluar_nonjual
			$this->keluar_nonjual->ViewValue = $this->keluar_nonjual->CurrentValue;
			$this->keluar_nonjual->ViewValue = FormatNumber($this->keluar_nonjual->ViewValue, 2, -2, -2, -2);
			$this->keluar_nonjual->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->keluar_nonjual->ViewCustomAttributes = "";

			// masuk_penyesuaian
			$this->masuk_penyesuaian->ViewValue = $this->masuk_penyesuaian->CurrentValue;
			$this->masuk_penyesuaian->ViewValue = FormatNumber($this->masuk_penyesuaian->ViewValue, 2, -2, -2, -2);
			$this->masuk_penyesuaian->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->masuk_penyesuaian->ViewCustomAttributes = "";

			// keluar_penyesuaian
			$this->keluar_penyesuaian->ViewValue = $this->keluar_penyesuaian->CurrentValue;
			$this->keluar_penyesuaian->ViewValue = FormatNumber($this->keluar_penyesuaian->ViewValue, 2, -2, -2, -2);
			$this->keluar_penyesuaian->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->keluar_penyesuaian->ViewCustomAttributes = "";

			// id_kirimbarang
			$this->id_kirimbarang->ViewValue = $this->id_kirimbarang->CurrentValue;
			$this->id_kirimbarang->ViewValue = FormatNumber($this->id_kirimbarang->ViewValue, 0, -2, -2, -2);
			$this->id_kirimbarang->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->id_kirimbarang->ViewCustomAttributes = "";

			// keluar_kirim
			$this->keluar_kirim->ViewValue = $this->keluar_kirim->CurrentValue;
			$this->keluar_kirim->ViewValue = FormatNumber($this->keluar_kirim->ViewValue, 2, -2, -2, -2);
			$this->keluar_kirim->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->keluar_kirim->ViewCustomAttributes = "";

			// id_terimagudang
			$this->id_terimagudang->ViewValue = $this->id_terimagudang->CurrentValue;
			$this->id_terimagudang->ViewValue = FormatNumber($this->id_terimagudang->ViewValue, 0, -2, -2, -2);
			$this->id_terimagudang->CellCssClass = ($this->RecordCount % 2 != 1 ? "ew-table-alt-row" : "ew-table-row");
			$this->id_terimagudang->ViewCustomAttributes = "";

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

			// stok_awal
			$this->stok_awal->LinkCustomAttributes = "";
			$this->stok_awal->HrefValue = "";
			$this->stok_awal->TooltipValue = "";

			// masuk
			$this->masuk->LinkCustomAttributes = "";
			$this->masuk->HrefValue = "";
			$this->masuk->TooltipValue = "";

			// keluar
			$this->keluar->LinkCustomAttributes = "";
			$this->keluar->HrefValue = "";
			$this->keluar->TooltipValue = "";

			// retur
			$this->retur->LinkCustomAttributes = "";
			$this->retur->HrefValue = "";
			$this->retur->TooltipValue = "";

			// stok_akhir
			$this->stok_akhir->LinkCustomAttributes = "";
			$this->stok_akhir->HrefValue = "";
			$this->stok_akhir->TooltipValue = "";

			// id_penyesuaian
			$this->id_penyesuaian->LinkCustomAttributes = "";
			$this->id_penyesuaian->HrefValue = "";
			$this->id_penyesuaian->TooltipValue = "";

			// id_nonjual
			$this->id_nonjual->LinkCustomAttributes = "";
			$this->id_nonjual->HrefValue = "";
			$this->id_nonjual->TooltipValue = "";

			// keluar_nonjual
			$this->keluar_nonjual->LinkCustomAttributes = "";
			$this->keluar_nonjual->HrefValue = "";
			$this->keluar_nonjual->TooltipValue = "";

			// masuk_penyesuaian
			$this->masuk_penyesuaian->LinkCustomAttributes = "";
			$this->masuk_penyesuaian->HrefValue = "";
			$this->masuk_penyesuaian->TooltipValue = "";

			// keluar_penyesuaian
			$this->keluar_penyesuaian->LinkCustomAttributes = "";
			$this->keluar_penyesuaian->HrefValue = "";
			$this->keluar_penyesuaian->TooltipValue = "";

			// id_kirimbarang
			$this->id_kirimbarang->LinkCustomAttributes = "";
			$this->id_kirimbarang->HrefValue = "";
			$this->id_kirimbarang->TooltipValue = "";

			// keluar_kirim
			$this->keluar_kirim->LinkCustomAttributes = "";
			$this->keluar_kirim->HrefValue = "";
			$this->keluar_kirim->TooltipValue = "";

			// id_terimagudang
			$this->id_terimagudang->LinkCustomAttributes = "";
			$this->id_terimagudang->HrefValue = "";
			$this->id_terimagudang->TooltipValue = "";
		}

		// Call Cell_Rendered event
		if ($this->RowType == ROWTYPE_TOTAL) { // Summary row

			// id_barang
			$currentValue = $this->id_barang->GroupViewValue;
			$viewValue = &$this->id_barang->GroupViewValue;
			$viewAttrs = &$this->id_barang->ViewAttrs;
			$cellAttrs = &$this->id_barang->CellAttrs;
			$hrefValue = &$this->id_barang->HrefValue;
			$linkAttrs = &$this->id_barang->LinkAttrs;
			$this->Cell_Rendered($this->id_barang, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// stok_awal
			$currentValue = $this->stok_awal->SumValue;
			$viewValue = &$this->stok_awal->SumViewValue;
			$viewAttrs = &$this->stok_awal->ViewAttrs;
			$cellAttrs = &$this->stok_awal->CellAttrs;
			$hrefValue = &$this->stok_awal->HrefValue;
			$linkAttrs = &$this->stok_awal->LinkAttrs;
			$this->Cell_Rendered($this->stok_awal, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// masuk
			$currentValue = $this->masuk->SumValue;
			$viewValue = &$this->masuk->SumViewValue;
			$viewAttrs = &$this->masuk->ViewAttrs;
			$cellAttrs = &$this->masuk->CellAttrs;
			$hrefValue = &$this->masuk->HrefValue;
			$linkAttrs = &$this->masuk->LinkAttrs;
			$this->Cell_Rendered($this->masuk, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// keluar
			$currentValue = $this->keluar->SumValue;
			$viewValue = &$this->keluar->SumViewValue;
			$viewAttrs = &$this->keluar->ViewAttrs;
			$cellAttrs = &$this->keluar->CellAttrs;
			$hrefValue = &$this->keluar->HrefValue;
			$linkAttrs = &$this->keluar->LinkAttrs;
			$this->Cell_Rendered($this->keluar, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// retur
			$currentValue = $this->retur->SumValue;
			$viewValue = &$this->retur->SumViewValue;
			$viewAttrs = &$this->retur->ViewAttrs;
			$cellAttrs = &$this->retur->CellAttrs;
			$hrefValue = &$this->retur->HrefValue;
			$linkAttrs = &$this->retur->LinkAttrs;
			$this->Cell_Rendered($this->retur, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// stok_akhir
			$currentValue = $this->stok_akhir->SumValue;
			$viewValue = &$this->stok_akhir->SumViewValue;
			$viewAttrs = &$this->stok_akhir->ViewAttrs;
			$cellAttrs = &$this->stok_akhir->CellAttrs;
			$hrefValue = &$this->stok_akhir->HrefValue;
			$linkAttrs = &$this->stok_akhir->LinkAttrs;
			$this->Cell_Rendered($this->stok_akhir, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);
		} else {

			// id_barang
			$currentValue = $this->id_barang->groupValue();
			$viewValue = &$this->id_barang->GroupViewValue;
			$viewAttrs = &$this->id_barang->ViewAttrs;
			$cellAttrs = &$this->id_barang->CellAttrs;
			$hrefValue = &$this->id_barang->HrefValue;
			$linkAttrs = &$this->id_barang->LinkAttrs;
			$this->Cell_Rendered($this->id_barang, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// id_klinik
			$currentValue = $this->id_klinik->CurrentValue;
			$viewValue = &$this->id_klinik->ViewValue;
			$viewAttrs = &$this->id_klinik->ViewAttrs;
			$cellAttrs = &$this->id_klinik->CellAttrs;
			$hrefValue = &$this->id_klinik->HrefValue;
			$linkAttrs = &$this->id_klinik->LinkAttrs;
			$this->Cell_Rendered($this->id_klinik, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// tanggal
			$currentValue = $this->tanggal->CurrentValue;
			$viewValue = &$this->tanggal->ViewValue;
			$viewAttrs = &$this->tanggal->ViewAttrs;
			$cellAttrs = &$this->tanggal->CellAttrs;
			$hrefValue = &$this->tanggal->HrefValue;
			$linkAttrs = &$this->tanggal->LinkAttrs;
			$this->Cell_Rendered($this->tanggal, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// stok_awal
			$currentValue = $this->stok_awal->CurrentValue;
			$viewValue = &$this->stok_awal->ViewValue;
			$viewAttrs = &$this->stok_awal->ViewAttrs;
			$cellAttrs = &$this->stok_awal->CellAttrs;
			$hrefValue = &$this->stok_awal->HrefValue;
			$linkAttrs = &$this->stok_awal->LinkAttrs;
			$this->Cell_Rendered($this->stok_awal, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// masuk
			$currentValue = $this->masuk->CurrentValue;
			$viewValue = &$this->masuk->ViewValue;
			$viewAttrs = &$this->masuk->ViewAttrs;
			$cellAttrs = &$this->masuk->CellAttrs;
			$hrefValue = &$this->masuk->HrefValue;
			$linkAttrs = &$this->masuk->LinkAttrs;
			$this->Cell_Rendered($this->masuk, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// keluar
			$currentValue = $this->keluar->CurrentValue;
			$viewValue = &$this->keluar->ViewValue;
			$viewAttrs = &$this->keluar->ViewAttrs;
			$cellAttrs = &$this->keluar->CellAttrs;
			$hrefValue = &$this->keluar->HrefValue;
			$linkAttrs = &$this->keluar->LinkAttrs;
			$this->Cell_Rendered($this->keluar, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// retur
			$currentValue = $this->retur->CurrentValue;
			$viewValue = &$this->retur->ViewValue;
			$viewAttrs = &$this->retur->ViewAttrs;
			$cellAttrs = &$this->retur->CellAttrs;
			$hrefValue = &$this->retur->HrefValue;
			$linkAttrs = &$this->retur->LinkAttrs;
			$this->Cell_Rendered($this->retur, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// stok_akhir
			$currentValue = $this->stok_akhir->CurrentValue;
			$viewValue = &$this->stok_akhir->ViewValue;
			$viewAttrs = &$this->stok_akhir->ViewAttrs;
			$cellAttrs = &$this->stok_akhir->CellAttrs;
			$hrefValue = &$this->stok_akhir->HrefValue;
			$linkAttrs = &$this->stok_akhir->LinkAttrs;
			$this->Cell_Rendered($this->stok_akhir, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// id_penyesuaian
			$currentValue = $this->id_penyesuaian->CurrentValue;
			$viewValue = &$this->id_penyesuaian->ViewValue;
			$viewAttrs = &$this->id_penyesuaian->ViewAttrs;
			$cellAttrs = &$this->id_penyesuaian->CellAttrs;
			$hrefValue = &$this->id_penyesuaian->HrefValue;
			$linkAttrs = &$this->id_penyesuaian->LinkAttrs;
			$this->Cell_Rendered($this->id_penyesuaian, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// id_nonjual
			$currentValue = $this->id_nonjual->CurrentValue;
			$viewValue = &$this->id_nonjual->ViewValue;
			$viewAttrs = &$this->id_nonjual->ViewAttrs;
			$cellAttrs = &$this->id_nonjual->CellAttrs;
			$hrefValue = &$this->id_nonjual->HrefValue;
			$linkAttrs = &$this->id_nonjual->LinkAttrs;
			$this->Cell_Rendered($this->id_nonjual, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// keluar_nonjual
			$currentValue = $this->keluar_nonjual->CurrentValue;
			$viewValue = &$this->keluar_nonjual->ViewValue;
			$viewAttrs = &$this->keluar_nonjual->ViewAttrs;
			$cellAttrs = &$this->keluar_nonjual->CellAttrs;
			$hrefValue = &$this->keluar_nonjual->HrefValue;
			$linkAttrs = &$this->keluar_nonjual->LinkAttrs;
			$this->Cell_Rendered($this->keluar_nonjual, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// masuk_penyesuaian
			$currentValue = $this->masuk_penyesuaian->CurrentValue;
			$viewValue = &$this->masuk_penyesuaian->ViewValue;
			$viewAttrs = &$this->masuk_penyesuaian->ViewAttrs;
			$cellAttrs = &$this->masuk_penyesuaian->CellAttrs;
			$hrefValue = &$this->masuk_penyesuaian->HrefValue;
			$linkAttrs = &$this->masuk_penyesuaian->LinkAttrs;
			$this->Cell_Rendered($this->masuk_penyesuaian, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// keluar_penyesuaian
			$currentValue = $this->keluar_penyesuaian->CurrentValue;
			$viewValue = &$this->keluar_penyesuaian->ViewValue;
			$viewAttrs = &$this->keluar_penyesuaian->ViewAttrs;
			$cellAttrs = &$this->keluar_penyesuaian->CellAttrs;
			$hrefValue = &$this->keluar_penyesuaian->HrefValue;
			$linkAttrs = &$this->keluar_penyesuaian->LinkAttrs;
			$this->Cell_Rendered($this->keluar_penyesuaian, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// id_kirimbarang
			$currentValue = $this->id_kirimbarang->CurrentValue;
			$viewValue = &$this->id_kirimbarang->ViewValue;
			$viewAttrs = &$this->id_kirimbarang->ViewAttrs;
			$cellAttrs = &$this->id_kirimbarang->CellAttrs;
			$hrefValue = &$this->id_kirimbarang->HrefValue;
			$linkAttrs = &$this->id_kirimbarang->LinkAttrs;
			$this->Cell_Rendered($this->id_kirimbarang, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// keluar_kirim
			$currentValue = $this->keluar_kirim->CurrentValue;
			$viewValue = &$this->keluar_kirim->ViewValue;
			$viewAttrs = &$this->keluar_kirim->ViewAttrs;
			$cellAttrs = &$this->keluar_kirim->CellAttrs;
			$hrefValue = &$this->keluar_kirim->HrefValue;
			$linkAttrs = &$this->keluar_kirim->LinkAttrs;
			$this->Cell_Rendered($this->keluar_kirim, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);

			// id_terimagudang
			$currentValue = $this->id_terimagudang->CurrentValue;
			$viewValue = &$this->id_terimagudang->ViewValue;
			$viewAttrs = &$this->id_terimagudang->ViewAttrs;
			$cellAttrs = &$this->id_terimagudang->CellAttrs;
			$hrefValue = &$this->id_terimagudang->HrefValue;
			$linkAttrs = &$this->id_terimagudang->LinkAttrs;
			$this->Cell_Rendered($this->id_terimagudang, $currentValue, $viewValue, $viewAttrs, $cellAttrs, $hrefValue, $linkAttrs);
		}

		// Call Row_Rendered event
		$this->Row_Rendered();
		$this->setupFieldCount();
	}
	private $_groupCounts = [];

	// Get group count
	public function getGroupCount(...$args)
	{
		$key = "";
		foreach($args as $arg) {
			if ($key != "")
				$key .= "_";
			$key .= strval($arg);
		}
		if ($key == "") {
			return -1;
		} elseif ($key == "0") { // Number of first level groups
			$i = 1;
			while (isset($this->_groupCounts[strval($i)]))
				$i++;
			return $i - 1;
		}
		return isset($this->_groupCounts[$key]) ? $this->_groupCounts[$key] : -1;
	}

	// Set group count
	public function setGroupCount($value, ...$args)
	{
		$key = "";
		foreach($args as $arg) {
			if ($key != "")
				$key .= "_";
			$key .= strval($arg);
		}
		if ($key == "")
			return;
		$this->_groupCounts[$key] = $value;
	}

	// Setup field count
	protected function setupFieldCount()
	{
		$this->GroupColumnCount = 0;
		$this->SubGroupColumnCount = 0;
		$this->DetailColumnCount = 0;
		if ($this->id_barang->Visible)
			$this->GroupColumnCount += 1;
		if ($this->id_klinik->Visible)
			$this->DetailColumnCount += 1;
		if ($this->tanggal->Visible)
			$this->DetailColumnCount += 1;
		if ($this->stok_awal->Visible)
			$this->DetailColumnCount += 1;
		if ($this->masuk->Visible)
			$this->DetailColumnCount += 1;
		if ($this->keluar->Visible)
			$this->DetailColumnCount += 1;
		if ($this->retur->Visible)
			$this->DetailColumnCount += 1;
		if ($this->stok_akhir->Visible)
			$this->DetailColumnCount += 1;
		if ($this->id_penyesuaian->Visible)
			$this->DetailColumnCount += 1;
		if ($this->id_nonjual->Visible)
			$this->DetailColumnCount += 1;
		if ($this->keluar_nonjual->Visible)
			$this->DetailColumnCount += 1;
		if ($this->masuk_penyesuaian->Visible)
			$this->DetailColumnCount += 1;
		if ($this->keluar_penyesuaian->Visible)
			$this->DetailColumnCount += 1;
		if ($this->id_kirimbarang->Visible)
			$this->DetailColumnCount += 1;
		if ($this->keluar_kirim->Visible)
			$this->DetailColumnCount += 1;
		if ($this->id_terimagudang->Visible)
			$this->DetailColumnCount += 1;
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			return '<a class="ew-export-link ew-excel" title="' . HtmlEncode($Language->phrase("ExportToExcel", TRUE)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToExcel", TRUE)) . '" href="#" onclick="return ew.exportWithCharts(event, \'' . $this->ExportExcelUrl . '\', \'' . session_id() . '\');">' . $Language->phrase("ExportToExcel") . '</a>';
		} elseif (SameText($type, "word")) {
			return '<a class="ew-export-link ew-word" title="' . HtmlEncode($Language->phrase("ExportToWord", TRUE)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToWord", TRUE)) . '" href="#" onclick="return ew.exportWithCharts(event, \'' . $this->ExportWordUrl . '\', \'' . session_id() . '\');">' . $Language->phrase("ExportToWord") . '</a>';
		} elseif (SameText($type, "pdf")) {
			return '<a class="ew-export-link ew-pdf" title="' . HtmlEncode($Language->phrase("ExportToPDF", TRUE)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToPDF", TRUE)) . '" href="#" onclick="return ew.exportWithCharts(event, \'' . $this->ExportPdfUrl . '\', \'' . session_id() . '\');">' . $Language->phrase("ExportToPDF") . '</a>';
		} elseif (SameText($type, "email")) {
			return '<a class="ew-export-link ew-email" title="' . HtmlEncode($Language->phrase("ExportToEmail", TRUE)) . '" data-caption="' . HtmlEncode($Language->phrase("ExportToEmail", TRUE)) . '" id="emf_report_rekap" href="#" onclick="return ew.emailDialogShow({ lnk: \'emf_report_rekap\', hdr: ew.language.phrase(\'ExportToEmailText\'), url: \'' . $this->pageUrl() . 'export=email\', exportid: \'' . session_id() . '\', el: this });">' . $Language->phrase("ExportToEmail") . '</a>';
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

		// Export to Pdf
		$item = &$this->ExportOptions->add("pdf");
		$item->Body = $this->getExportTag("pdf");
		$item->Visible = FALSE;

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

		// Hide options for export
		if ($this->isExport())
			$this->ExportOptions->hideAllOptions();
	}

	// Set up search options
	protected function setupSearchOptions()
	{
		global $Language;
		$this->SearchOptions = new ListOptions("div");
		$this->SearchOptions->TagClassName = "ew-search-option";

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

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->add("summary", $this->TableVar, $url, "", $this->TableVar, TRUE);
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
				case "x_id_penjualan":
					break;
				case "x_id_retur":
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
						case "x_id_penjualan":
							break;
						case "x_id_retur":
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

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;

		// Filter button
		$item = &$this->FilterOptions->add("savecurrentfilter");
		$item->Body = "<a class=\"ew-save-filter\" data-form=\"fsummary\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = FALSE;
		$item = &$this->FilterOptions->add("deletefilter");
		$item->Body = "<a class=\"ew-delete-filter\" data-form=\"fsummary\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
		$item->Visible = FALSE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

// Export to Word
	public function exportReportWord($html)
	{
		global $ExportFileName;
		$doc = new \DOMDocument();
		$html = preg_replace('/<meta\b(?:[^"\'>]|"[^"]*"|\'[^\']*\')*>/i', "", $html); // Remove meta tags
		@$doc->loadHTML('<?xml encoding="uft-8">' . ConvertToUtf8($html)); // Convert to utf-8
		$tables = $doc->getElementsByTagName("table");
		$phpword = new \PhpOffice\PhpWord\PhpWord();
		$section = $phpword->createSection(["orientation" => $this->ExportWordPageOrientation]);
		$cellwidth = $this->ExportWordColumnWidth;
		$div = $doc->getElementById("ew-filter-list");
		if ($div) {
			$parent = $div->parentNode;
			$cls = $parent->getAttribute("class");
			if (preg_match('/\bd-none\b/', $cls)) {
				$div2 = $doc->getElementById("ew-current-date");
				if ($div2) {
					$value = trim($div2->textContent);
					$section->addText($value);
				}
				$div2 = $doc->getElementById("ew-current-filters");
				if ($div2) {
					$value = trim($div2->textContent);
					$section->addText($value);
				}
				$spans = $div->getElementsByTagName("span");
				$spancnt = $spans->length;
				for ($i = 0; $i < $spancnt; $i++) {
					$span = $spans->item($i);
					$class = $span->getAttribute("class");
					if ($class == "ew-filter-caption") {
						$caption = trim($span->textContent);
						$i++;
						$span = $spans->item($i);
						$class = $span->getAttribute("class");
						if ($class == "ew-filter-value") {
							$value = trim($span->textContent);
							$section->addText($caption . ": " . $value);
						}
					}
				}
			}
		}
		foreach ($tables as $table) {
			$tableclass = $table->getAttribute("class");
			$type = "";
			if (ContainsText($tableclass, "ew-table"))
				$type = "table";
			elseif (ContainsText($tableclass, "ew-chart"))
				$type = "chart";
			if ($type == "table" || $type == "chart") {

				// Check page break for chart (before)
				if ($type == "chart" && $this->ExportChartPageBreak && $table->getAttribute("data-page-break") == "before")
					$section->addPageBreak();
				if ($type == "chart") {
					$images = $table->getElementsByTagName("img");
					$cnt = $images->length;
					for ($z = 0; $z < $cnt; $z++) {
						$imagefn = $images->item($z)->getAttribute("src");
						if (file_exists($imagefn)) {
							$size = getimagesize($imagefn);
							if ($size[0] != 0) {
								$settings = $section->getSettings();
								$factor = \PhpOffice\PhpWord\Shared\Converter::INCH_TO_PIXEL / \PhpOffice\PhpWord\Shared\Converter::INCH_TO_TWIP; // 96/1440
								$w = min($size[0], ($settings->getPageSizeW() - $settings->getMarginLeft() - $settings->getMarginRight()) * $factor);
								$h = $w / $size[0] * $size[1];
								$section->addImage($imagefn, ["width" => $w, "height" => $h]);
							} else {
								$section->addImage($imagefn);
							}
						}
					}
				} elseif ($type == "table") {
					$styleTable = ["borderSize" => 6, "borderColor" => "A9A9A9", "cellMargin" => 60]; // Customize table cell styles here
					$phpword->addTableStyle("phpWord", $styleTable);
					$tbl = $section->addTable("phpWord");
					$rows = $table->getElementsByTagName("tr");
					$rowcnt = $rows->length;
					for ($i = 0; $i < $rowcnt; $i++) {
						$row = $rows->item($i);
						if (!($row->parentNode->tagName == "table" && $row->parentNode->getAttribute("class") == "ew-table-header-btn")) {
							$cells = $row->childNodes;
							$cellcnt = $cells->length;
							$tbl->addRow(0);
							for ($j = 0; $j < $cellcnt; $j++) {
								$cell = $cells->item($j);
								if ($cell->nodeType != XML_ELEMENT_NODE || $cell->tagName != "td" && $cell->tagName != "th")
									continue;
								$k = 1;
								if ($cell->hasAttribute("colspan"))
									$k = intval($cell->getAttribute("colspan"));
								$images = $cell->getElementsByTagName("img");
								if ($images->length >= 1) { // Image
									$cell = $tbl->addCell($cellwidth);
									$cnt = $images->length; 
									for ($z = 0; $z < $cnt; $z++) {
										$imagefn = $images->item($z)->getAttribute("src");
										if (file_exists($imagefn))
											$cell->addImage($imagefn);
									}
								} else { // Text
									$text = htmlspecialchars(trim($cell->textContent), ENT_NOQUOTES);
									$text = preg_replace(['/[\r\n\t]+:/', '/[\r\n\t]+\(/'], [":", " ("], trim($text)); // Replace extra whitespaces before ":" and "("
									if ($row->parentNode->tagName == "thead") { // Caption
										$tbl->addCell($cellwidth, ["gridSpan" => $k, "bgColor" => "E4E4E4"])->addText($text, ["bold" => TRUE]); // Customize table header cell styles here
									} else {
										$tbl->addCell($cellwidth, ["gridSpan" => $k])->addText($text);
									}
								}
							}
						}
					}
				}

				// Check page break for chart (after)
				if ($type == "chart" && $this->ExportChartPageBreak && $table->getAttribute("data-page-break") == "after")
					$section->addPageBreak();

				// Check page break for table
				if ($type == "table") {
					$node = $table->parentNode;
					while ($node && $node->getAttribute("class") && !ContainsText($node->getAttribute("class"), "ew-grid"))
						$node = $node->parentNode;
					if ($node) {
						$node = $node->nextSibling;
						while ($node && $node->nodeType != XML_ELEMENT_NODE)
							$node = $node->nextSibling;
						if ($node && $node->getAttribute("class") && $node->getAttribute("class") == "ew-page-break")
							$section->addPageBreak();
					}
				}
			}
		}
		if (!Config("DEBUG") && ob_get_length())
			ob_end_clean();
		header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
		header('Content-Disposition: attachment; filename=' . $ExportFileName . '.docx');
		header('Cache-Control: max-age=0');
		header('Set-Cookie: fileDownload=true; path=/');
		$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpword, 'Word2007');
		@$objWriter->save('php://output');
		DeleteTempImages();
		exit();
	}

// Export report to Excel
	public function exportReportExcel($html, $format = "Excel5")
	{
		global $ExportFileName;
		$doc = new \DOMDocument();
		$html = preg_replace('/<meta\b(?:[^"\'>]|"[^"]*"|\'[^\']*\')*>/i', "", $html); // Remove meta tags
		@$doc->loadHTML('<?xml encoding="uft-8">' . ConvertToUtf8($html)); // Convert to utf-8
		$tables = $doc->getElementsByTagName("table");
		$phpspreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
		$phpspreadsheet->setActiveSheetIndex(0);
		$sheet = $phpspreadsheet->getActiveSheet();
		if ($this->ExportExcelPageOrientation != "")
			$sheet->getPageSetup()->setOrientation($this->ExportExcelPageOrientation);
		if ($this->ExportExcelPageSize != "")
			$sheet->getPageSetup()->setPaperSize($this->ExportExcelPageSize);
		if (function_exists("PhpSpreadsheet_Rendering")) // For user's own use only
			PhpSpreadsheet_Rendering($sheet);
		$maxImageWidth = ($format == "Excel5") ? ExportExcel5::$MaxImageWidth : ExportExcel2007::$MaxImageWidth; // Max image width <= 400 is recommended
		$widthMultiplier = ($format == "Excel5") ? ExportExcel5::$WidthMultiplier : ExportExcel2007::$WidthMultiplier; // Cell width multipler for image fields
		$heightMultiplier = ($format == "Excel5") ? ExportExcel5::$HeightMultiplier : ExportExcel2007::$HeightMultiplier; // Row height multipler for image fields
		$m = 1; $maxcellcnt = 1;
		foreach ($tables as $table) {
			$tableclass = $table->getAttribute("class");
			$isChart = ContainsText($tableclass, "ew-chart");
			$isTable = ContainsText($tableclass, "ew-table");
			if ($isTable || $isChart) {

				// Check page break for chart (before)
				if ($isChart && $this->ExportChartPageBreak && $table->getAttribute("data-page-break") == "before") {
					$sheet->setBreak("A" . strval($m), \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::BREAK_ROW);
					$m++;
				}
				$rows = $table->getElementsByTagName("tr");
				$rowcnt = $rows->length;
				for ($i = 0; $i < $rowcnt; $i++) {
					$row = $rows->item($i);
					$cells = $row->childNodes;
					$cellcnt = $cells->length;
					$k = 1;
					for ($j = 0; $j < $cellcnt; $j++) {
						$cell = $cells->item($j);
						if ($cell->nodeType != XML_ELEMENT_NODE || $cell->tagName != "td")
							continue;
						$letter =\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($k);
						$images = $cell->getElementsByTagName("img");
						if ($images->length > 0) { // Images
							$totalW = 0;
							$maxH = 0;
							foreach ($images as $image) {
								$fn = $image->getAttribute("src");
								$path = parse_url($fn, PHP_URL_PATH);
								$ext = pathinfo($path, PATHINFO_EXTENSION);
								if (SameText($ext, "php")) { // Image by script
									$fn = FullUrl($fn);
									$data = file_get_contents($fn);
									$fn = TempImage($data);
								}
								if (!file_exists($fn) || is_dir($fn))
									continue;
								$objDrawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
								$objDrawing->setWorksheet($sheet);
								$objDrawing->setPath($fn);
								$objDrawing->setOffsetX($totalW);
								$objDrawing->setCoordinates($letter . strval($m));
								$size = [$objDrawing->getWidth(), $objDrawing->getHeight()]; // Get image size
								if ($size[0] > 0) // Width
									$totalW += $size[0];
								$maxH = max($maxH, $size[1]); // Height
							}
							if ($totalW > 0 && $isTable) // Width
								$sheet->getColumnDimension($letter)->setAutoSize(FALSE)->setWidth($totalW * $widthMultiplier); // Set column width, no auto size
							if ($maxH > 0) // Height
								$sheet->getRowDimension($m)->setRowHeight($maxH * $heightMultiplier); // Set row height
						} else { // Text
							$value = preg_replace(['/[\r\n\t]+:/', '/[\r\n\t]+\(/'], [":", " ("], trim($cell->textContent)); // Replace extra whitespaces before ":" and "("
							if (function_exists("PhpSpreadsheet_Cell_Rendering")) // For user's own use only
								PhpSpreadsheet_Cell_Rendering($k, $m, $value, $sheet);
							if ($format == "Excel2007" && $row->parentNode->tagName == "thead") { // Caption
								$objRichText = new \PhpOffice\PhpSpreadsheet\RichText\RichText(); // Rich Text
								$obj = $objRichText->createTextRun($value);
								$obj->getFont()->setBold(TRUE); // Bold

								//$obj->getFont()->setItalic(true);
								//$obj->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_DARKGREEN)); // Set color

								$sheet->getCellByColumnAndRow($k, $m)->setValue($objRichText);
							} else {
								$sheet->setCellValueByColumnAndRow($k, $m, $value);
							}
							$sheet->getColumnDimension($letter)->setAutoSize(TRUE);
							if (function_exists("PhpSpreadsheet_Cell_Rendered")) // For user's own use only
								PhpSpreadsheet_Cell_Rendered($k, $m, $value, $sheet);
						}
						if ($cell->hasAttribute("colspan")) {
							$k += (int)$cell->getAttribute("colspan");
						} else {
							$k++;
						}
					}
					if ($k > $maxcellcnt)
						$maxcellcnt = $k;
					$m++;
				}

				// Check page break for chart (after)
				if ($isChart && $this->ExportChartPageBreak && $table->getAttribute("data-page-break") == "after")
					$sheet->setBreak("A" . strval($m), \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::BREAK_ROW);

				// Check page break for table
				if ($isTable) {
					$node = $table->parentNode;
					while ($node && $node->getAttribute("class") && !ContainsText($node->getAttribute("class"), "ew-grid"))
						$node = $node->parentNode;
					if ($node) {
						$node = $node->nextSibling;
						while ($node && $node->nodeType != XML_ELEMENT_NODE)
							$node = $node->nextSibling;
						if ($node && $node->getAttribute("class") && $node->getAttribute("class") == "ew-page-break")
							$sheet->setBreak("A" . strval($m), \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::BREAK_ROW);
					}
				}
				$m++;
			}
		}
		if (!Config("DEBUG") && ob_get_length())
			ob_end_clean();
		if ($format == "Excel5") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $ExportFileName . '.xls');
		} else { // Excel2007
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment; filename=' . $ExportFileName . '.xlsx');
		}
		header('Cache-Control: max-age=0');
		header('Set-Cookie: fileDownload=true; path=/');
		$objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($phpspreadsheet, ($format == "Excel5") ? "Xls" : "Xlsx");
		$objWriter->save('php://output');
		DeleteTempImages();
		exit();
	}

// Export PDF
	public function exportReportPdf($html)
	{
		global $ExportFileName;
		@ini_set("memory_limit", Config("PDF_MEMORY_LIMIT"));
		set_time_limit(Config("PDF_TIME_LIMIT"));
		$html = CheckHtml($html);
		if (Config("DEBUG")) // Add debug message
			$html = str_replace("</body>", GetDebugMessage() . "</body>", $html);
		$dompdf = new \Dompdf\Dompdf(["pdf_backend" => "TCPDF"]);
		$doc = new \DOMDocument("1.0", "utf-8");
		@$doc->loadHTML('<?xml encoding="uft-8">' . ConvertToUtf8($html)); // Convert to utf-8
		$spans = $doc->getElementsByTagName("span");
		foreach ($spans as $span) {
			$classNames = $span->getAttribute("class");
			if ($classNames == "ew-filter-caption") // Insert colon
				$span->parentNode->insertBefore($doc->createElement("span", ":&nbsp;"), $span->nextSibling);
			elseif (preg_match('/\bicon\-\w+\b/', $classNames)) // Remove icons
				$span->parentNode->removeChild($span);
		}
		$images = $doc->getElementsByTagName("img");
		$pageSize = $this->ExportPageSize;
		$pageOrientation = $this->ExportPageOrientation;
		$portrait = SameText($pageOrientation, "portrait");
		foreach ($images as $image) {
			$imagefn = $image->getAttribute("src");
			if (file_exists($imagefn)) {
				$imagefn = realpath($imagefn);
				$size = getimagesize($imagefn); // Get image size
				if ($size[0] != 0) {
					if (SameText($pageSize, "letter")) { // Letter paper (8.5 in. by 11 in.)
						$w = $portrait ? 216 : 279;
					} elseif (SameText($pageSize, "legal")) { // Legal paper (8.5 in. by 14 in.)
						$w = $portrait ? 216 : 356;
					} else {
						$w = $portrait ? 210 : 297; // A4 paper (210 mm by 297 mm)
					}
					$w = min($size[0], ($w - 20 * 2) / 25.4 * 72 * Config("PDF_IMAGE_SCALE_FACTOR")); // Resize image, adjust the scale factor if necessary
					$h = $w / $size[0] * $size[1];
					$image->setAttribute("width", $w);
					$image->setAttribute("height", $h);
				}
			}
		}
		$html = $doc->saveHTML();
		$html = ConvertFromUtf8($html);
		$dompdf->load_html($html);
		$dompdf->set_paper($pageSize, $pageOrientation);
		$dompdf->render();
		header('Set-Cookie: fileDownload=true; path=/');
		$exportFile = EndsText(".pdf", $ExportFileName) ? $ExportFileName : $ExportFileName . ".pdf";
		$dompdf->stream($exportFile, ["Attachment" => 1]); // 0 to open in browser, 1 to download
		DeleteTempImages();
		exit();
	}

	// Set up starting group
	protected function setupStartGroup()
	{

		// Exit if no groups
		if ($this->DisplayGroups == 0)
			return;
		$startGrp = Param(Config("TABLE_START_GROUP"), "");
		$pageNo = Param("pageno", "");

		// Check for a 'start' parameter
		if ($startGrp != "") {
			$this->StartGroup = $startGrp;
			$this->setStartGroup($this->StartGroup);
		} elseif ($pageNo != "") {
			if (is_numeric($pageNo)) {
				$this->StartGroup = ($pageNo - 1) * $this->DisplayGroups + 1;
				if ($this->StartGroup <= 0) {
					$this->StartGroup = 1;
				} elseif ($this->StartGroup >= intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1) {
					$this->StartGroup = intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1;
				}
				$this->setStartGroup($this->StartGroup);
			} else {
				$this->StartGroup = $this->getStartGroup();
			}
		} else {
			$this->StartGroup = $this->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGroup) || $this->StartGroup == "") { // Avoid invalid start group counter
			$this->StartGroup = 1; // Reset start group counter
			$this->setStartGroup($this->StartGroup);
		} elseif (intval($this->StartGroup) > intval($this->TotalGroups)) { // Avoid starting group > total groups
			$this->StartGroup = intval(($this->TotalGroups - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1; // Point to last page first group
			$this->setStartGroup($this->StartGroup);
		} elseif (($this->StartGroup-1) % $this->DisplayGroups != 0) {
			$this->StartGroup = intval(($this->StartGroup - 1) / $this->DisplayGroups) * $this->DisplayGroups + 1; // Point to page boundary
			$this->setStartGroup($this->StartGroup);
		}
	}

	// Reset pager
	protected function resetPager()
	{

		// Reset start position (reset command)
		$this->StartGroup = 1;
		$this->setStartGroup($this->StartGroup);
	}

	// Set up number of groups displayed per page
	protected function setupDisplayGroups()
	{
		if (Param(Config("TABLE_GROUP_PER_PAGE")) !== NULL) {
			$wrk = Param(Config("TABLE_GROUP_PER_PAGE"));
			if (is_numeric($wrk)) {
				$this->DisplayGroups = intval($wrk);
			} else {
				if (strtoupper($wrk) == "ALL") { // Display all groups
					$this->DisplayGroups = -1;
				} else {
					$this->DisplayGroups = 3; // Non-numeric, load default
				}
			}
			$this->setGroupPerPage($this->DisplayGroups); // Save to session

			// Reset start position (reset command)
			$this->StartGroup = 1;
			$this->setStartGroup($this->StartGroup);
		} else {
			if ($this->getGroupPerPage() != "") {
				$this->DisplayGroups = $this->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGroups = 3; // Load default
			}
		}
	}

	// Get sort parameters based on sort links clicked
	protected function getSort()
	{
		if ($this->DrillDown)
			return "";
		$resetSort = Param("cmd") === "resetsort";
		$orderBy = Param("order", "");
		$orderType = Param("ordertype", "");

		// Check for a resetsort command
		if ($resetSort) {
			$this->setOrderBy("");
			$this->setStartGroup(1);
			$this->id_barang->setSort("");
			$this->id_klinik->setSort("");
			$this->tanggal->setSort("");
			$this->stok_awal->setSort("");
			$this->masuk->setSort("");
			$this->keluar->setSort("");
			$this->retur->setSort("");
			$this->stok_akhir->setSort("");
			$this->id_penyesuaian->setSort("");
			$this->id_nonjual->setSort("");
			$this->keluar_nonjual->setSort("");
			$this->masuk_penyesuaian->setSort("");
			$this->keluar_penyesuaian->setSort("");
			$this->id_kirimbarang->setSort("");
			$this->keluar_kirim->setSort("");
			$this->id_terimagudang->setSort("");

		// Check for an Order parameter
		} elseif ($orderBy != "") {
			$this->CurrentOrder = $orderBy;
			$this->CurrentOrderType = $orderType;
			$this->updateSort($this->id_barang); // id_barang
			$this->updateSort($this->id_klinik); // id_klinik
			$this->updateSort($this->tanggal); // tanggal
			$this->updateSort($this->stok_awal); // stok_awal
			$this->updateSort($this->masuk); // masuk
			$this->updateSort($this->keluar); // keluar
			$this->updateSort($this->retur); // retur
			$this->updateSort($this->stok_akhir); // stok_akhir
			$this->updateSort($this->id_penyesuaian); // id_penyesuaian
			$this->updateSort($this->id_nonjual); // id_nonjual
			$this->updateSort($this->keluar_nonjual); // keluar_nonjual
			$this->updateSort($this->masuk_penyesuaian); // masuk_penyesuaian
			$this->updateSort($this->keluar_penyesuaian); // keluar_penyesuaian
			$this->updateSort($this->id_kirimbarang); // id_kirimbarang
			$this->updateSort($this->keluar_kirim); // keluar_kirim
			$this->updateSort($this->id_terimagudang); // id_terimagudang
			$sortSql = $this->sortSql();
			$this->setOrderBy($sortSql);
			$this->setStartGroup(1);
		}
		return $this->getOrderBy();
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

	// Page Breaking event
	function Page_Breaking(&$break, &$content) {

		// Example:
		//$break = FALSE; // Skip page break, or
		//$content = "<div style=\"page-break-after:always;\">&nbsp;</div>"; // Modify page break content

	}

	// Load Filters event
	function Page_FilterLoad() {

		// Enter your code here
		// Example: Register/Unregister Custom Extended Filter
		//RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A', PROJECT_NAMESPACE . 'GetStartsWithAFilter'); // With function, or
		//RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A'); // No function, use Page_Filtering event
		//UnregisterFilter($this-><Field>, 'StartsWithA');

	}

	// Page Selecting event
	function Page_Selecting(&$filter) {

		// Enter your code here
	}

	// Page Filter Validated event
	function Page_FilterValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Page Filtering event
	function Page_Filtering(&$fld, &$filter, $typ, $opr = "", $val = "", $cond = "", $opr2 = "", $val2 = "") {

		// Note: ALWAYS CHECK THE FILTER TYPE ($typ)! Example:
		//if ($typ == "dropdown" && $fld->Name == "MyField") // Dropdown filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "extended" && $fld->Name == "MyField") // Extended filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "popup" && $fld->Name == "MyField") // Popup filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "custom" && $opr == "..." && $fld->Name == "MyField") // Custom filter, $opr is the custom filter ID
		//	$filter = "..."; // Modify the filter

	}

	// Cell Rendered event
	function Cell_Rendered(&$Field, $CurrentValue, &$ViewValue, &$ViewAttrs, &$CellAttrs, &$HrefValue, &$LinkAttrs) {

		//$ViewValue = "xxx";
		//$ViewAttrs["class"] = "xxx";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>