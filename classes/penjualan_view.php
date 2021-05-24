<?php
namespace PHPMaker2020\sim_klinik_alamanda;

/**
 * Page class
 */
class penjualan_view extends penjualan
{

	// Page ID
	public $PageID = "view";

	// Project ID
	public $ProjectID = "{8546B030-7993-4749-BFDB-17AFAAF4065D}";

	// Table name
	public $TableName = 'penjualan';

	// Page object name
	public $PageObjName = "penjualan_view";

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
		$keyUrl = "";
		if (Get("id") !== NULL) {
			$this->RecKey["id"] = Get("id");
			$keyUrl .= "&amp;id=" . urlencode($this->RecKey["id"]);
		}
		$this->ExportPrintUrl = $this->pageUrl() . "export=print" . $keyUrl;
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html" . $keyUrl;
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel" . $keyUrl;
		$this->ExportWordUrl = $this->pageUrl() . "export=word" . $keyUrl;
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml" . $keyUrl;
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv" . $keyUrl;
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf" . $keyUrl;

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'view');

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

		// Export options
		$this->ExportOptions = new ListOptions("div");
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["action"] = new ListOptions("div");
		$this->OtherOptions["action"]->TagClassName = "ew-action-option";
		$this->OtherOptions["detail"] = new ListOptions("div");
		$this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "penjualanview.php")
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
	public $ExportOptions; // Export options
	public $OtherOptions; // Other options
	public $DisplayRecords = 1;
	public $DbMasterFilter;
	public $DbDetailFilter;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $RecKey = [];
	public $IsModal = FALSE;
	public $detailpenjualan_Count;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canView()) {
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
			if (!$Security->canView()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("penjualanlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
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
		if (Get("id") !== NULL) {
			if ($ExportFileName != "")
				$ExportFileName .= "_";
			$ExportFileName .= Get("id");
		}

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

		// Setup export options
		$this->setupExportOptions();
		$this->id->setVisibility();
		$this->kode_penjualan->setVisibility();
		$this->id_pelanggan->setVisibility();
		$this->id_member->setVisibility();
		$this->waktu->setVisibility();
		$this->diskon_persen->setVisibility();
		$this->diskon_rupiah->setVisibility();
		$this->ppn->setVisibility();
		$this->total->setVisibility();
		$this->bayar->setVisibility();
		$this->bayar_non_tunai->setVisibility();
		$this->total_non_tunai_charge->setVisibility();
		$this->keterangan->setVisibility();
		$this->id_klinik->setVisibility();
		$this->id_rmd->setVisibility();
		$this->metode_pembayaran->setVisibility();
		$this->id_bank->setVisibility();
		$this->id_kartu->setVisibility();
		$this->sales->setVisibility();
		$this->dok_be_wajah->setVisibility();
		$this->be_body->setVisibility();
		$this->medis->setVisibility();
		$this->dokter->setVisibility();
		$this->id_kartubank->setVisibility();
		$this->id_kas->setVisibility();
		$this->charge->setVisibility();
		$this->klaim_poin->setVisibility();
		$this->total_penukaran_poin->setVisibility();
		$this->ongkir->setVisibility();
		$this->_action->setVisibility();
		$this->status->setVisibility();
		$this->status_void->setVisibility();
		$this->jumlah_voucher->setVisibility();
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

		// Check permission
		if (!$Security->canView()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("penjualanlist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;

		// Load current record
		$loadCurrentRecord = FALSE;
		$returnUrl = "";
		$matchRecord = FALSE;
		if ($this->isPageRequest()) { // Validate request
			if (Get("id") !== NULL) {
				$this->id->setQueryStringValue(Get("id"));
				$this->RecKey["id"] = $this->id->QueryStringValue;
			} elseif (IsApi() && Key(0) !== NULL) {
				$this->id->setQueryStringValue(Key(0));
				$this->RecKey["id"] = $this->id->QueryStringValue;
			} elseif (Post("id") !== NULL) {
				$this->id->setFormValue(Post("id"));
				$this->RecKey["id"] = $this->id->FormValue;
			} elseif (IsApi() && Route(2) !== NULL) {
				$this->id->setFormValue(Route(2));
				$this->RecKey["id"] = $this->id->FormValue;
			} else {
				$returnUrl = "penjualanlist.php"; // Return to list
			}

			// Get action
			$this->CurrentAction = "show"; // Display
			switch ($this->CurrentAction) {
				case "show": // Get a record to display

					// Load record based on key
					if (IsApi()) {
						$filter = $this->getRecordFilter();
						$this->CurrentFilter = $filter;
						$sql = $this->getCurrentSql();
						$conn = $this->getConnection();
						$this->Recordset = LoadRecordset($sql, $conn);
						$res = $this->Recordset && !$this->Recordset->EOF;
					} else {
						$res = $this->loadRow();
					}
					if (!$res) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
						$returnUrl = "penjualanlist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if (!$this->CustomExport && in_array($this->Export, array_keys(Config("EXPORT_CLASSES")))) {
				$this->exportData();
				$this->terminate();
			}
		} else {
			$returnUrl = "penjualanlist.php"; // Not page request, return to list
		}
		if ($returnUrl != "") {
			$this->terminate($returnUrl);
			return;
		}

		// Set up Breadcrumb
		if (!$this->isExport())
			$this->setupBreadcrumb();

		// Render row
		$this->RowType = ROWTYPE_VIEW;
		$this->resetAttributes();
		$this->renderRow();

		// Set up detail parameters
		$this->setupDetailParms();

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset, TRUE); // Get current record only
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows]);
			$this->terminate(TRUE);
		}
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["action"];

		// Add
		$item = &$option->add("add");
		$addcaption = HtmlTitle($Language->phrase("ViewPageAddLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->AddUrl) . "'});\">" . $Language->phrase("ViewPageAddLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("ViewPageAddLink") . "</a>";
		$item->Visible = ($this->AddUrl != "" && $Security->canAdd());

		// Edit
		$item = &$option->add("edit");
		$editcaption = HtmlTitle($Language->phrase("ViewPageEditLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->EditUrl) . "'});\">" . $Language->phrase("ViewPageEditLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->phrase("ViewPageEditLink") . "</a>";
		$item->Visible = ($this->EditUrl != "" && $Security->canEdit());

		// Copy
		$item = &$option->add("copy");
		$copycaption = HtmlTitle($Language->phrase("ViewPageCopyLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ew-action ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'AddBtn',url:'" . HtmlEncode($this->CopyUrl) . "'});\">" . $Language->phrase("ViewPageCopyLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode($this->CopyUrl) . "\">" . $Language->phrase("ViewPageCopyLink") . "</a>";
		$item->Visible = ($this->CopyUrl != "" && $Security->canAdd());

		// Delete
		$item = &$option->add("delete");
		if ($this->IsModal) // Handle as inline delete
			$item->Body = "<a onclick=\"return ew.confirmDelete(this);\" class=\"ew-action ew-delete\" title=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" href=\"" . HtmlEncode(UrlAddQuery($this->DeleteUrl, "action=1")) . "\">" . $Language->phrase("ViewPageDeleteLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-delete\" title=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" href=\"" . HtmlEncode($this->DeleteUrl) . "\">" . $Language->phrase("ViewPageDeleteLink") . "</a>";
		$item->Visible = ($this->DeleteUrl != "" && $Security->canDelete());
		$option = $options["detail"];
		$detailTableLink = "";
		$detailViewTblVar = "";
		$detailCopyTblVar = "";
		$detailEditTblVar = "";

		// "detail_detailpenjualan"
		$item = &$option->add("detail_detailpenjualan");
		$body = $Language->phrase("ViewPageDetailLink") . $Language->TablePhrase("detailpenjualan", "TblCaption");
		$body .= "&nbsp;" . str_replace("%c", $this->detailpenjualan_Count, $Language->phrase("DetailCount"));
		$body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("detailpenjualanlist.php?" . Config("TABLE_SHOW_MASTER") . "=penjualan&fk_id=" . urlencode(strval($this->id->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if (!isset($GLOBALS["detailpenjualan_grid"]))
			$GLOBALS["detailpenjualan_grid"] = new detailpenjualan_grid();
		if ($GLOBALS["detailpenjualan_grid"]->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'penjualan')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=detailpenjualan")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			if ($detailViewTblVar != "")
				$detailViewTblVar .= ",";
			$detailViewTblVar .= "detailpenjualan";
		}
		if ($GLOBALS["detailpenjualan_grid"]->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'penjualan')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=detailpenjualan")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			if ($detailEditTblVar != "")
				$detailEditTblVar .= ",";
			$detailEditTblVar .= "detailpenjualan";
		}
		if ($GLOBALS["detailpenjualan_grid"]->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'penjualan')) {
			$links .= "<li><a class=\"ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailCopyLink")) . "\" href=\"" . HtmlEncode($this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=detailpenjualan")) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailCopyLink")) . "</a></li>";
			if ($detailCopyTblVar != "")
				$detailCopyTblVar .= ",";
			$detailCopyTblVar .= "detailpenjualan";
		}
		if ($links != "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-toggle=\"dropdown\"></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = $Security->allowList(CurrentProjectID() . 'detailpenjualan');
		if ($item->Visible) {
			if ($detailTableLink != "")
				$detailTableLink .= ",";
			$detailTableLink .= "detailpenjualan";
		}
		if ($this->ShowMultipleDetails)
			$item->Visible = FALSE;

		// Multiple details
		if ($this->ShowMultipleDetails) {
			$body = "<div class=\"btn-group btn-group-sm ew-btn-group\">";
			$links = "";
			if ($detailViewTblVar != "") {
				$links .= "<li><a class=\"ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailViewLink")) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailViewTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailViewLink")) . "</a></li>";
			}
			if ($detailEditTblVar != "") {
				$links .= "<li><a class=\"ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailEditLink")) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailEditTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailEditLink")) . "</a></li>";
			}
			if ($detailCopyTblVar != "") {
				$links .= "<li><a class=\"ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($Language->phrase("MasterDetailCopyLink")) . "\" href=\"" . HtmlEncode($this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailCopyTblVar)) . "\">" . HtmlImageAndText($Language->phrase("MasterDetailCopyLink")) . "</a></li>";
			}
			if ($links != "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default ew-master-detail\" title=\"" . HtmlTitle($Language->phrase("MultipleMasterDetails")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("MultipleMasterDetails") . "</button>";
				$body .= "<ul class=\"dropdown-menu ew-menu\">". $links . "</ul>";
			}
			$body .= "</div>";

			// Multiple details
			$item = &$option->add("details");
			$item->Body = $body;
		}

		// Set up detail default
		$option = $options["detail"];
		$options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
		$ar = explode(",", $detailTableLink);
		$cnt = count($ar);
		$option->UseDropDownButton = ($cnt > 1);
		$option->UseButtonGroup = TRUE;
		$item = &$option->add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Set up action default
		$option = $options["action"];
		$option->DropDownButtonPhrase = $Language->phrase("ButtonActions");
		$option->UseDropDownButton = FALSE;
		$option->UseButtonGroup = TRUE;
		$item = &$option->add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
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
		if ($this->AuditTrailOnView)
			$this->writeAuditTrailOnView($row);
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

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		$this->AddUrl = $this->getAddUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();
		$this->ListUrl = $this->getListUrl();
		$this->setupOtherOptions();

		// Convert decimal values if posted back
		if ($this->diskon_rupiah->FormValue == $this->diskon_rupiah->CurrentValue && is_numeric(ConvertToFloatString($this->diskon_rupiah->CurrentValue)))
			$this->diskon_rupiah->CurrentValue = ConvertToFloatString($this->diskon_rupiah->CurrentValue);

		// Convert decimal values if posted back
		if ($this->ppn->FormValue == $this->ppn->CurrentValue && is_numeric(ConvertToFloatString($this->ppn->CurrentValue)))
			$this->ppn->CurrentValue = ConvertToFloatString($this->ppn->CurrentValue);

		// Convert decimal values if posted back
		if ($this->total->FormValue == $this->total->CurrentValue && is_numeric(ConvertToFloatString($this->total->CurrentValue)))
			$this->total->CurrentValue = ConvertToFloatString($this->total->CurrentValue);

		// Convert decimal values if posted back
		if ($this->bayar->FormValue == $this->bayar->CurrentValue && is_numeric(ConvertToFloatString($this->bayar->CurrentValue)))
			$this->bayar->CurrentValue = ConvertToFloatString($this->bayar->CurrentValue);

		// Convert decimal values if posted back
		if ($this->bayar_non_tunai->FormValue == $this->bayar_non_tunai->CurrentValue && is_numeric(ConvertToFloatString($this->bayar_non_tunai->CurrentValue)))
			$this->bayar_non_tunai->CurrentValue = ConvertToFloatString($this->bayar_non_tunai->CurrentValue);

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

		// Convert decimal values if posted back
		if ($this->ongkir->FormValue == $this->ongkir->CurrentValue && is_numeric(ConvertToFloatString($this->ongkir->CurrentValue)))
			$this->ongkir->CurrentValue = ConvertToFloatString($this->ongkir->CurrentValue);

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

			// jumlah_voucher
			$this->jumlah_voucher->ViewValue = $this->jumlah_voucher->CurrentValue;
			$this->jumlah_voucher->ViewValue = FormatNumber($this->jumlah_voucher->ViewValue, 0, -2, -2, -2);
			$this->jumlah_voucher->ViewCustomAttributes = "";

			// kode_penjualan
			$this->kode_penjualan->LinkCustomAttributes = "";
			$this->kode_penjualan->HrefValue = "";
			$this->kode_penjualan->TooltipValue = "";

			// id_pelanggan
			$this->id_pelanggan->LinkCustomAttributes = "";
			$this->id_pelanggan->HrefValue = "";
			$this->id_pelanggan->TooltipValue = "";

			// id_member
			$this->id_member->LinkCustomAttributes = "";
			$this->id_member->HrefValue = "";
			$this->id_member->TooltipValue = "";

			// waktu
			$this->waktu->LinkCustomAttributes = "";
			$this->waktu->HrefValue = "";
			$this->waktu->TooltipValue = "";

			// diskon_persen
			$this->diskon_persen->LinkCustomAttributes = "";
			$this->diskon_persen->HrefValue = "";
			$this->diskon_persen->TooltipValue = "";

			// diskon_rupiah
			$this->diskon_rupiah->LinkCustomAttributes = "";
			$this->diskon_rupiah->HrefValue = "";
			$this->diskon_rupiah->TooltipValue = "";

			// ppn
			$this->ppn->LinkCustomAttributes = "";
			$this->ppn->HrefValue = "";
			$this->ppn->TooltipValue = "";

			// total
			$this->total->LinkCustomAttributes = "";
			$this->total->HrefValue = "";
			$this->total->TooltipValue = "";

			// bayar
			$this->bayar->LinkCustomAttributes = "";
			$this->bayar->HrefValue = "";
			$this->bayar->TooltipValue = "";

			// bayar_non_tunai
			$this->bayar_non_tunai->LinkCustomAttributes = "";
			$this->bayar_non_tunai->HrefValue = "";
			$this->bayar_non_tunai->TooltipValue = "";

			// total_non_tunai_charge
			$this->total_non_tunai_charge->LinkCustomAttributes = "";
			$this->total_non_tunai_charge->HrefValue = "";
			$this->total_non_tunai_charge->TooltipValue = "";

			// keterangan
			$this->keterangan->LinkCustomAttributes = "";
			$this->keterangan->HrefValue = "";
			$this->keterangan->TooltipValue = "";

			// id_klinik
			$this->id_klinik->LinkCustomAttributes = "";
			$this->id_klinik->HrefValue = "";
			$this->id_klinik->TooltipValue = "";

			// id_rmd
			$this->id_rmd->LinkCustomAttributes = "";
			$this->id_rmd->HrefValue = "";
			$this->id_rmd->TooltipValue = "";

			// metode_pembayaran
			$this->metode_pembayaran->LinkCustomAttributes = "";
			$this->metode_pembayaran->HrefValue = "";
			$this->metode_pembayaran->TooltipValue = "";

			// id_bank
			$this->id_bank->LinkCustomAttributes = "";
			$this->id_bank->HrefValue = "";
			$this->id_bank->TooltipValue = "";

			// id_kartu
			$this->id_kartu->LinkCustomAttributes = "";
			$this->id_kartu->HrefValue = "";
			$this->id_kartu->TooltipValue = "";

			// sales
			$this->sales->LinkCustomAttributes = "";
			$this->sales->HrefValue = "";
			$this->sales->TooltipValue = "";

			// dok_be_wajah
			$this->dok_be_wajah->LinkCustomAttributes = "";
			$this->dok_be_wajah->HrefValue = "";
			$this->dok_be_wajah->TooltipValue = "";

			// be_body
			$this->be_body->LinkCustomAttributes = "";
			$this->be_body->HrefValue = "";
			$this->be_body->TooltipValue = "";

			// medis
			$this->medis->LinkCustomAttributes = "";
			$this->medis->HrefValue = "";
			$this->medis->TooltipValue = "";

			// dokter
			$this->dokter->LinkCustomAttributes = "";
			$this->dokter->HrefValue = "";
			$this->dokter->TooltipValue = "";

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

			// ongkir
			$this->ongkir->LinkCustomAttributes = "";
			$this->ongkir->HrefValue = "";
			$this->ongkir->TooltipValue = "";

			// action
			$this->_action->LinkCustomAttributes = "";
			$this->_action->HrefValue = "";
			$this->_action->TooltipValue = "";

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";
			$this->status->TooltipValue = "";

			// status_void
			$this->status_void->LinkCustomAttributes = "";
			$this->status_void->HrefValue = "";
			$this->status_void->TooltipValue = "";

			// jumlah_voucher
			$this->jumlah_voucher->LinkCustomAttributes = "";
			$this->jumlah_voucher->HrefValue = "";
			$this->jumlah_voucher->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Get export HTML tag
	protected function getExportTag($type, $custom = FALSE)
	{
		global $Language;
		if (SameText($type, "excel")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fpenjualanview, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
			else
				return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
		} elseif (SameText($type, "word")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fpenjualanview, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
			else
				return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
		} elseif (SameText($type, "pdf")) {
			if ($custom)
				return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fpenjualanview, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
			return '<button id="emf_penjualan" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_penjualan\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fpenjualanview, key:' . ArrayToJsonAttribute($this->RecKey) . ', sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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

		// Hide options for export
		if ($this->isExport())
			$this->ExportOptions->hideAllOptions();
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
		$selectLimit = FALSE;

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
		$this->setupStartRecord(); // Set up start record position

		// Set the last record to display
		if ($this->DisplayRecords <= 0) {
			$this->StopRecord = $this->TotalRecords;
		} else {
			$this->StopRecord = $this->StartRecord + $this->DisplayRecords - 1;
		}
		$this->ExportDoc = GetExportDocument($this, "v");
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
		$this->exportDocument($doc, $rs, $this->StartRecord, $this->StopRecord, "view");

		// Export detail records (detailpenjualan)
		if (Config("EXPORT_DETAIL_RECORDS") && in_array("detailpenjualan", explode(",", $this->getCurrentDetailTable()))) {
			global $detailpenjualan;
			if (!isset($detailpenjualan))
				$detailpenjualan = new detailpenjualan();
			$rsdetail = $detailpenjualan->loadRs($detailpenjualan->getDetailFilter()); // Load detail records
			if ($rsdetail && !$rsdetail->EOF) {
				$exportStyle = $doc->Style;
				$doc->setStyle("h"); // Change to horizontal
				if (!$this->isExport("csv") || Config("EXPORT_DETAIL_RECORDS_FOR_CSV")) {
					$doc->exportEmptyRow();
					$detailcnt = $rsdetail->RecordCount();
					$oldtbl = $doc->Table;
					$doc->Table = $detailpenjualan;
					$detailpenjualan->exportDocument($doc, $rsdetail, 1, $detailcnt);
					$doc->Table = $oldtbl;
				}
				$doc->setStyle($exportStyle); // Restore
				$rsdetail->close();
			}
		}
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
			if (in_array("detailpenjualan", $detailTblVar)) {
				if (!isset($GLOBALS["detailpenjualan_grid"]))
					$GLOBALS["detailpenjualan_grid"] = new detailpenjualan_grid();
				if ($GLOBALS["detailpenjualan_grid"]->DetailView) {
					$GLOBALS["detailpenjualan_grid"]->CurrentMode = "view";

					// Save current master table to detail table
					$GLOBALS["detailpenjualan_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["detailpenjualan_grid"]->setStartRecordNumber(1);
					$GLOBALS["detailpenjualan_grid"]->id_penjualan->IsDetailKey = TRUE;
					$GLOBALS["detailpenjualan_grid"]->id_penjualan->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["detailpenjualan_grid"]->id_penjualan->setSessionValue($GLOBALS["detailpenjualan_grid"]->id_penjualan->CurrentValue);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("penjualanlist.php"), "", $this->TableVar, TRUE);
		$pageId = "view";
		$Breadcrumb->add("view", $pageId, $url);
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
} // End class
?>