<?php
namespace PHPMaker2020\sim_klinik_alamanda;

/**
 * Page class
 */
class penjualan_search extends penjualan
{

	// Page ID
	public $PageID = "search";

	// Project ID
	public $ProjectID = "{8546B030-7993-4749-BFDB-17AFAAF4065D}";

	// Table name
	public $TableName = 'penjualan';

	// Page object name
	public $PageObjName = "penjualan_search";

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

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'search');

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
	public $FormClassName = "ew-horizontal ew-form ew-search-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$SearchError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

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
			if (!$Security->canSearch()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("penjualanlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
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
		$this->jumlah_voucher->setVisibility();
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

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		if ($this->isPageRequest()) { // Validate request

			// Get action
			$this->CurrentAction = Post("action");
			if ($this->isSearch()) {

				// Build search string for advanced search, remove blank field
				$this->loadSearchValues(); // Get search values
				if ($this->validateSearch()) {
					$srchStr = $this->buildAdvancedSearch();
				} else {
					$srchStr = "";
					$this->setFailureMessage($SearchError);
				}
				if ($srchStr != "") {
					$srchStr = $this->getUrlParm($srchStr);
					$srchStr = "penjualanlist.php" . "?" . $srchStr;
					$this->terminate($srchStr); // Go to list page
				}
			}
		}

		// Restore search settings from Session
		if ($SearchError == "")
			$this->loadAdvancedSearch();

		// Render row for search
		$this->RowType = ROWTYPE_SEARCH;
		$this->resetAttributes();
		$this->renderRow();
	}

	// Build advanced search
	protected function buildAdvancedSearch()
	{
		$srchUrl = "";
		$this->buildSearchUrl($srchUrl, $this->id); // id
		$this->buildSearchUrl($srchUrl, $this->kode_penjualan); // kode_penjualan
		$this->buildSearchUrl($srchUrl, $this->id_pelanggan); // id_pelanggan
		$this->buildSearchUrl($srchUrl, $this->id_member); // id_member
		$this->buildSearchUrl($srchUrl, $this->waktu); // waktu
		$this->buildSearchUrl($srchUrl, $this->diskon_persen); // diskon_persen
		$this->buildSearchUrl($srchUrl, $this->diskon_rupiah); // diskon_rupiah
		$this->buildSearchUrl($srchUrl, $this->ppn); // ppn
		$this->buildSearchUrl($srchUrl, $this->total); // total
		$this->buildSearchUrl($srchUrl, $this->bayar); // bayar
		$this->buildSearchUrl($srchUrl, $this->bayar_non_tunai); // bayar_non_tunai
		$this->buildSearchUrl($srchUrl, $this->total_non_tunai_charge); // total_non_tunai_charge
		$this->buildSearchUrl($srchUrl, $this->keterangan); // keterangan
		$this->buildSearchUrl($srchUrl, $this->id_klinik); // id_klinik
		$this->buildSearchUrl($srchUrl, $this->id_rmd); // id_rmd
		$this->buildSearchUrl($srchUrl, $this->metode_pembayaran); // metode_pembayaran
		$this->buildSearchUrl($srchUrl, $this->id_bank); // id_bank
		$this->buildSearchUrl($srchUrl, $this->id_kartu); // id_kartu
		$this->buildSearchUrl($srchUrl, $this->jumlah_voucher); // jumlah_voucher
		$this->buildSearchUrl($srchUrl, $this->sales); // sales
		$this->buildSearchUrl($srchUrl, $this->dok_be_wajah); // dok_be_wajah
		$this->buildSearchUrl($srchUrl, $this->be_body); // be_body
		$this->buildSearchUrl($srchUrl, $this->medis); // medis
		$this->buildSearchUrl($srchUrl, $this->dokter); // dokter
		$this->buildSearchUrl($srchUrl, $this->id_kartubank); // id_kartubank
		$this->buildSearchUrl($srchUrl, $this->id_kas); // id_kas
		$this->buildSearchUrl($srchUrl, $this->charge); // charge
		$this->buildSearchUrl($srchUrl, $this->klaim_poin); // klaim_poin
		$this->buildSearchUrl($srchUrl, $this->total_penukaran_poin); // total_penukaran_poin
		$this->buildSearchUrl($srchUrl, $this->ongkir); // ongkir
		$this->buildSearchUrl($srchUrl, $this->_action); // action
		$this->buildSearchUrl($srchUrl, $this->status); // status
		$this->buildSearchUrl($srchUrl, $this->status_void); // status_void
		if ($srchUrl != "")
			$srchUrl .= "&";
		$srchUrl .= "cmd=search";
		return $srchUrl;
	}

	// Build search URL
	protected function buildSearchUrl(&$url, &$fld, $oprOnly = FALSE)
	{
		global $CurrentForm;
		$wrk = "";
		$fldParm = $fld->Param;
		$fldVal = $CurrentForm->getValue("x_$fldParm");
		$fldOpr = $CurrentForm->getValue("z_$fldParm");
		$fldCond = $CurrentForm->getValue("v_$fldParm");
		$fldVal2 = $CurrentForm->getValue("y_$fldParm");
		$fldOpr2 = $CurrentForm->getValue("w_$fldParm");
		if (is_array($fldVal))
			$fldVal = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal);
		if (is_array($fldVal2))
			$fldVal2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal2);
		$fldOpr = strtoupper(trim($fldOpr));
		$fldDataType = ($fld->IsVirtual) ? DATATYPE_STRING : $fld->DataType;
		if ($fldOpr == "BETWEEN") {
			$isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal) && $this->searchValueIsNumeric($fld, $fldVal2));
			if ($fldVal != "" && $fldVal2 != "" && $isValidValue) {
				$wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
					"&y_" . $fldParm . "=" . urlencode($fldVal2) .
					"&z_" . $fldParm . "=" . urlencode($fldOpr);
			}
		} else {
			$isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal));
			if ($fldVal != "" && $isValidValue && IsValidOperator($fldOpr, $fldDataType)) {
				$wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
					"&z_" . $fldParm . "=" . urlencode($fldOpr);
			} elseif ($fldOpr == "IS NULL" || $fldOpr == "IS NOT NULL" || ($fldOpr != "" && $oprOnly && IsValidOperator($fldOpr, $fldDataType))) {
				$wrk = "z_" . $fldParm . "=" . urlencode($fldOpr);
			}
			$isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal2));
			if ($fldVal2 != "" && $isValidValue && IsValidOperator($fldOpr2, $fldDataType)) {
				if ($wrk != "")
					$wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
				$wrk .= "y_" . $fldParm . "=" . urlencode($fldVal2) .
					"&w_" . $fldParm . "=" . urlencode($fldOpr2);
			} elseif ($fldOpr2 == "IS NULL" || $fldOpr2 == "IS NOT NULL" || ($fldOpr2 != "" && $oprOnly && IsValidOperator($fldOpr2, $fldDataType))) {
				if ($wrk != "")
					$wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
				$wrk .= "w_" . $fldParm . "=" . urlencode($fldOpr2);
			}
		}
		if ($wrk != "") {
			if ($url != "")
				$url .= "&";
			$url .= $wrk;
		}
	}
	protected function searchValueIsNumeric($fld, $value)
	{
		if (IsFloatFormat($fld->Type))
			$value = ConvertToFloatString($value);
		return is_numeric($value);
	}

	// Load search values for validation
	protected function loadSearchValues()
	{

		// Load search values
		$got = FALSE;
		if ($this->id->AdvancedSearch->post())
			$got = TRUE;
		if ($this->kode_penjualan->AdvancedSearch->post())
			$got = TRUE;
		if ($this->id_pelanggan->AdvancedSearch->post())
			$got = TRUE;
		if ($this->id_member->AdvancedSearch->post())
			$got = TRUE;
		if ($this->waktu->AdvancedSearch->post())
			$got = TRUE;
		if ($this->diskon_persen->AdvancedSearch->post())
			$got = TRUE;
		if ($this->diskon_rupiah->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ppn->AdvancedSearch->post())
			$got = TRUE;
		if ($this->total->AdvancedSearch->post())
			$got = TRUE;
		if ($this->bayar->AdvancedSearch->post())
			$got = TRUE;
		if ($this->bayar_non_tunai->AdvancedSearch->post())
			$got = TRUE;
		if ($this->total_non_tunai_charge->AdvancedSearch->post())
			$got = TRUE;
		if ($this->keterangan->AdvancedSearch->post())
			$got = TRUE;
		if ($this->id_klinik->AdvancedSearch->post())
			$got = TRUE;
		if ($this->id_rmd->AdvancedSearch->post())
			$got = TRUE;
		if ($this->metode_pembayaran->AdvancedSearch->post())
			$got = TRUE;
		if ($this->id_bank->AdvancedSearch->post())
			$got = TRUE;
		if ($this->id_kartu->AdvancedSearch->post())
			$got = TRUE;
		if ($this->jumlah_voucher->AdvancedSearch->post())
			$got = TRUE;
		if ($this->sales->AdvancedSearch->post())
			$got = TRUE;
		if ($this->dok_be_wajah->AdvancedSearch->post())
			$got = TRUE;
		if ($this->be_body->AdvancedSearch->post())
			$got = TRUE;
		if ($this->medis->AdvancedSearch->post())
			$got = TRUE;
		if ($this->dokter->AdvancedSearch->post())
			$got = TRUE;
		if ($this->id_kartubank->AdvancedSearch->post())
			$got = TRUE;
		if ($this->id_kas->AdvancedSearch->post())
			$got = TRUE;
		if ($this->charge->AdvancedSearch->post())
			$got = TRUE;
		if ($this->klaim_poin->AdvancedSearch->post())
			$got = TRUE;
		if ($this->total_penukaran_poin->AdvancedSearch->post())
			$got = TRUE;
		if ($this->ongkir->AdvancedSearch->post())
			$got = TRUE;
		if ($this->_action->AdvancedSearch->post())
			$got = TRUE;
		if ($this->status->AdvancedSearch->post())
			$got = TRUE;
		if ($this->status_void->AdvancedSearch->post())
			$got = TRUE;
		return $got;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
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
		// jumlah_voucher
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

			// jumlah_voucher
			$this->jumlah_voucher->ViewValue = $this->jumlah_voucher->CurrentValue;
			$this->jumlah_voucher->ViewValue = FormatNumber($this->jumlah_voucher->ViewValue, 0, -2, -2, -2);
			$this->jumlah_voucher->ViewCustomAttributes = "";

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

			// id
			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";
			$this->id->TooltipValue = "";

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

			// jumlah_voucher
			$this->jumlah_voucher->LinkCustomAttributes = "";
			$this->jumlah_voucher->HrefValue = "";
			$this->jumlah_voucher->TooltipValue = "";

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
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// id
			$this->id->EditAttrs["class"] = "form-control";
			$this->id->EditCustomAttributes = "";
			$this->id->EditValue = HtmlEncode($this->id->AdvancedSearch->SearchValue);
			$this->id->PlaceHolder = RemoveHtml($this->id->caption());

			// kode_penjualan
			$this->kode_penjualan->EditAttrs["class"] = "form-control";
			$this->kode_penjualan->EditCustomAttributes = "";
			if (!$this->kode_penjualan->Raw)
				$this->kode_penjualan->AdvancedSearch->SearchValue = HtmlDecode($this->kode_penjualan->AdvancedSearch->SearchValue);
			$this->kode_penjualan->EditValue = HtmlEncode($this->kode_penjualan->AdvancedSearch->SearchValue);
			$this->kode_penjualan->PlaceHolder = RemoveHtml($this->kode_penjualan->caption());

			// id_pelanggan
			$this->id_pelanggan->EditAttrs["class"] = "form-control";
			$this->id_pelanggan->EditCustomAttributes = "";
			$this->id_pelanggan->EditValue = HtmlEncode($this->id_pelanggan->AdvancedSearch->SearchValue);
			$this->id_pelanggan->PlaceHolder = RemoveHtml($this->id_pelanggan->caption());

			// id_member
			$this->id_member->EditAttrs["class"] = "form-control";
			$this->id_member->EditCustomAttributes = "Readonly";
			$this->id_member->EditValue = HtmlEncode($this->id_member->AdvancedSearch->SearchValue);
			$curVal = strval($this->id_member->AdvancedSearch->SearchValue);
			if ($curVal != "") {
				$this->id_member->EditValue = $this->id_member->lookupCacheOption($curVal);
				if ($this->id_member->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id_jenis_member`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_member->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->id_member->EditValue = $this->id_member->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_member->EditValue = HtmlEncode($this->id_member->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->id_member->EditValue = NULL;
			}
			$this->id_member->PlaceHolder = RemoveHtml($this->id_member->caption());

			// waktu
			$this->waktu->EditAttrs["class"] = "form-control";
			$this->waktu->EditCustomAttributes = "";
			$this->waktu->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->waktu->AdvancedSearch->SearchValue, 7), 7));
			$this->waktu->PlaceHolder = RemoveHtml($this->waktu->caption());

			// diskon_persen
			$this->diskon_persen->EditAttrs["class"] = "form-control";
			$this->diskon_persen->EditCustomAttributes = "";
			if (!$this->diskon_persen->Raw)
				$this->diskon_persen->AdvancedSearch->SearchValue = HtmlDecode($this->diskon_persen->AdvancedSearch->SearchValue);
			$this->diskon_persen->EditValue = HtmlEncode($this->diskon_persen->AdvancedSearch->SearchValue);
			$this->diskon_persen->PlaceHolder = RemoveHtml($this->diskon_persen->caption());

			// diskon_rupiah
			$this->diskon_rupiah->EditAttrs["class"] = "form-control";
			$this->diskon_rupiah->EditCustomAttributes = "";
			$this->diskon_rupiah->EditValue = HtmlEncode($this->diskon_rupiah->AdvancedSearch->SearchValue);
			$this->diskon_rupiah->PlaceHolder = RemoveHtml($this->diskon_rupiah->caption());

			// ppn
			$this->ppn->EditAttrs["class"] = "form-control";
			$this->ppn->EditCustomAttributes = "";
			$this->ppn->EditValue = HtmlEncode($this->ppn->AdvancedSearch->SearchValue);
			$this->ppn->PlaceHolder = RemoveHtml($this->ppn->caption());

			// total
			$this->total->EditAttrs["class"] = "form-control";
			$this->total->EditCustomAttributes = "style='border:none; height:2em; font-size: 3em; background-color: white;' Readonly";
			$this->total->EditValue = HtmlEncode($this->total->AdvancedSearch->SearchValue);
			$this->total->PlaceHolder = RemoveHtml($this->total->caption());

			// bayar
			$this->bayar->EditAttrs["class"] = "form-control";
			$this->bayar->EditCustomAttributes = "";
			$this->bayar->EditValue = HtmlEncode($this->bayar->AdvancedSearch->SearchValue);
			$this->bayar->PlaceHolder = RemoveHtml($this->bayar->caption());

			// bayar_non_tunai
			$this->bayar_non_tunai->EditAttrs["class"] = "form-control";
			$this->bayar_non_tunai->EditCustomAttributes = "";
			$this->bayar_non_tunai->EditValue = HtmlEncode($this->bayar_non_tunai->AdvancedSearch->SearchValue);
			$this->bayar_non_tunai->PlaceHolder = RemoveHtml($this->bayar_non_tunai->caption());

			// total_non_tunai_charge
			$this->total_non_tunai_charge->EditAttrs["class"] = "form-control";
			$this->total_non_tunai_charge->EditCustomAttributes = 'Readonly';
			$this->total_non_tunai_charge->EditValue = HtmlEncode($this->total_non_tunai_charge->AdvancedSearch->SearchValue);
			$this->total_non_tunai_charge->PlaceHolder = RemoveHtml($this->total_non_tunai_charge->caption());

			// keterangan
			$this->keterangan->EditAttrs["class"] = "form-control";
			$this->keterangan->EditCustomAttributes = "";
			$this->keterangan->EditValue = HtmlEncode($this->keterangan->AdvancedSearch->SearchValue);
			$this->keterangan->PlaceHolder = RemoveHtml($this->keterangan->caption());

			// id_klinik
			$this->id_klinik->EditCustomAttributes = "";
			$curVal = trim(strval($this->id_klinik->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->id_klinik->AdvancedSearch->ViewValue = $this->id_klinik->lookupCacheOption($curVal);
			else
				$this->id_klinik->AdvancedSearch->ViewValue = $this->id_klinik->Lookup !== NULL && is_array($this->id_klinik->Lookup->Options) ? $curVal : NULL;
			if ($this->id_klinik->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->id_klinik->EditValue = array_values($this->id_klinik->Lookup->Options);
				if ($this->id_klinik->AdvancedSearch->ViewValue == "")
					$this->id_klinik->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_klinik`" . SearchString("=", $this->id_klinik->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->id_klinik->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->id_klinik->AdvancedSearch->ViewValue = $this->id_klinik->displayValue($arwrk);
				} else {
					$this->id_klinik->AdvancedSearch->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->id_klinik->EditValue = $arwrk;
			}

			// id_rmd
			$this->id_rmd->EditAttrs["class"] = "form-control";
			$this->id_rmd->EditCustomAttributes = "";
			$this->id_rmd->EditValue = HtmlEncode($this->id_rmd->AdvancedSearch->SearchValue);
			$curVal = strval($this->id_rmd->AdvancedSearch->SearchValue);
			if ($curVal != "") {
				$this->id_rmd->EditValue = $this->id_rmd->lookupCacheOption($curVal);
				if ($this->id_rmd->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id_rekmeddok`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_rmd->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->id_rmd->EditValue = $this->id_rmd->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_rmd->EditValue = HtmlEncode($this->id_rmd->AdvancedSearch->SearchValue);
					}
				}
			} else {
				$this->id_rmd->EditValue = NULL;
			}
			$this->id_rmd->PlaceHolder = RemoveHtml($this->id_rmd->caption());

			// metode_pembayaran
			$this->metode_pembayaran->EditAttrs["class"] = "form-control";
			$this->metode_pembayaran->EditCustomAttributes = "";
			$this->metode_pembayaran->EditValue = $this->metode_pembayaran->options(TRUE);

			// id_bank
			$this->id_bank->EditAttrs["class"] = "form-control";
			$this->id_bank->EditCustomAttributes = "";
			$curVal = trim(strval($this->id_bank->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->id_bank->AdvancedSearch->ViewValue = $this->id_bank->lookupCacheOption($curVal);
			else
				$this->id_bank->AdvancedSearch->ViewValue = $this->id_bank->Lookup !== NULL && is_array($this->id_bank->Lookup->Options) ? $curVal : NULL;
			if ($this->id_bank->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->id_bank->EditValue = array_values($this->id_bank->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_rekening`" . SearchString("=", $this->id_bank->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->id_bank->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$rowcnt = count($arwrk);
				for ($i = 0; $i < $rowcnt; $i++) {
					$arwrk[$i][1] = FormatNumber($arwrk[$i][1], 0, -2, -2, -2);
				}
				$this->id_bank->EditValue = $arwrk;
			}

			// id_kartu
			$this->id_kartu->EditAttrs["class"] = "form-control";
			$this->id_kartu->EditCustomAttributes = "";
			$curVal = trim(strval($this->id_kartu->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->id_kartu->AdvancedSearch->ViewValue = $this->id_kartu->lookupCacheOption($curVal);
			else
				$this->id_kartu->AdvancedSearch->ViewValue = $this->id_kartu->Lookup !== NULL && is_array($this->id_kartu->Lookup->Options) ? $curVal : NULL;
			if ($this->id_kartu->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->id_kartu->EditValue = array_values($this->id_kartu->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_kartu`" . SearchString("=", $this->id_kartu->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "`jenis` = 'Voucher'";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->id_kartu->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->id_kartu->EditValue = $arwrk;
			}

			// jumlah_voucher
			$this->jumlah_voucher->EditAttrs["class"] = "form-control";
			$this->jumlah_voucher->EditCustomAttributes = "";
			$this->jumlah_voucher->EditValue = HtmlEncode($this->jumlah_voucher->AdvancedSearch->SearchValue);
			$this->jumlah_voucher->PlaceHolder = RemoveHtml($this->jumlah_voucher->caption());

			// sales
			$this->sales->EditAttrs["class"] = "form-control";
			$this->sales->EditCustomAttributes = "";
			$curVal = trim(strval($this->sales->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->sales->AdvancedSearch->ViewValue = $this->sales->lookupCacheOption($curVal);
			else
				$this->sales->AdvancedSearch->ViewValue = $this->sales->Lookup !== NULL && is_array($this->sales->Lookup->Options) ? $curVal : NULL;
			if ($this->sales->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->sales->EditValue = array_values($this->sales->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_pegawai`" . SearchString("=", $this->sales->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "`status` <> 'Non Aktif'";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->sales->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$rowcnt = count($arwrk);
				for ($i = 0; $i < $rowcnt; $i++) {
					$arwrk[$i][2] = FormatNumber($arwrk[$i][2], 0, -2, -2, -2);
				}
				$this->sales->EditValue = $arwrk;
			}

			// dok_be_wajah
			$this->dok_be_wajah->EditAttrs["class"] = "form-control";
			$this->dok_be_wajah->EditCustomAttributes = "";
			$curVal = trim(strval($this->dok_be_wajah->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->dok_be_wajah->AdvancedSearch->ViewValue = $this->dok_be_wajah->lookupCacheOption($curVal);
			else
				$this->dok_be_wajah->AdvancedSearch->ViewValue = $this->dok_be_wajah->Lookup !== NULL && is_array($this->dok_be_wajah->Lookup->Options) ? $curVal : NULL;
			if ($this->dok_be_wajah->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->dok_be_wajah->EditValue = array_values($this->dok_be_wajah->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_pegawai`" . SearchString("=", $this->dok_be_wajah->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "`jabatan_pegawai` = 2 AND `status` <> 'Non Aktif'";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->dok_be_wajah->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$rowcnt = count($arwrk);
				for ($i = 0; $i < $rowcnt; $i++) {
					$arwrk[$i][2] = FormatNumber($arwrk[$i][2], 0, -2, -2, -2);
				}
				$this->dok_be_wajah->EditValue = $arwrk;
			}

			// be_body
			$this->be_body->EditAttrs["class"] = "form-control";
			$this->be_body->EditCustomAttributes = "";
			$curVal = trim(strval($this->be_body->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->be_body->AdvancedSearch->ViewValue = $this->be_body->lookupCacheOption($curVal);
			else
				$this->be_body->AdvancedSearch->ViewValue = $this->be_body->Lookup !== NULL && is_array($this->be_body->Lookup->Options) ? $curVal : NULL;
			if ($this->be_body->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->be_body->EditValue = array_values($this->be_body->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_pegawai`" . SearchString("=", $this->be_body->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "`jabatan_pegawai` = 3 AND `status` <> 'Non Aktif'";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->be_body->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$rowcnt = count($arwrk);
				for ($i = 0; $i < $rowcnt; $i++) {
					$arwrk[$i][2] = FormatNumber($arwrk[$i][2], 0, -2, -2, -2);
				}
				$this->be_body->EditValue = $arwrk;
			}

			// medis
			$this->medis->EditAttrs["class"] = "form-control";
			$this->medis->EditCustomAttributes = "";
			$curVal = trim(strval($this->medis->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->medis->AdvancedSearch->ViewValue = $this->medis->lookupCacheOption($curVal);
			else
				$this->medis->AdvancedSearch->ViewValue = $this->medis->Lookup !== NULL && is_array($this->medis->Lookup->Options) ? $curVal : NULL;
			if ($this->medis->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->medis->EditValue = array_values($this->medis->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_pegawai`" . SearchString("=", $this->medis->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "`jabatan_pegawai` = 4 AND `status` <> 'Non Aktif'";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->medis->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$rowcnt = count($arwrk);
				for ($i = 0; $i < $rowcnt; $i++) {
					$arwrk[$i][2] = FormatNumber($arwrk[$i][2], 0, -2, -2, -2);
				}
				$this->medis->EditValue = $arwrk;
			}

			// dokter
			$this->dokter->EditAttrs["class"] = "form-control";
			$this->dokter->EditCustomAttributes = "";
			$curVal = trim(strval($this->dokter->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->dokter->AdvancedSearch->ViewValue = $this->dokter->lookupCacheOption($curVal);
			else
				$this->dokter->AdvancedSearch->ViewValue = $this->dokter->Lookup !== NULL && is_array($this->dokter->Lookup->Options) ? $curVal : NULL;
			if ($this->dokter->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->dokter->EditValue = array_values($this->dokter->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_pegawai`" . SearchString("=", $this->dokter->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "`jabatan_pegawai` = 1 AND `status` <> 'Non Aktif'";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->dokter->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$rowcnt = count($arwrk);
				for ($i = 0; $i < $rowcnt; $i++) {
					$arwrk[$i][2] = FormatNumber($arwrk[$i][2], 0, -2, -2, -2);
				}
				$this->dokter->EditValue = $arwrk;
			}

			// id_kartubank
			$this->id_kartubank->EditAttrs["class"] = "form-control";
			$this->id_kartubank->EditCustomAttributes = "";
			$curVal = trim(strval($this->id_kartubank->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->id_kartubank->AdvancedSearch->ViewValue = $this->id_kartubank->lookupCacheOption($curVal);
			else
				$this->id_kartubank->AdvancedSearch->ViewValue = $this->id_kartubank->Lookup !== NULL && is_array($this->id_kartubank->Lookup->Options) ? $curVal : NULL;
			if ($this->id_kartubank->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->id_kartubank->EditValue = array_values($this->id_kartubank->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_kartu`" . SearchString("=", $this->id_kartubank->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "`jenis` <> 'Voucher'";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->id_kartubank->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->id_kartubank->EditValue = $arwrk;
			}

			// id_kas
			$this->id_kas->EditAttrs["class"] = "form-control";
			$this->id_kas->EditCustomAttributes = "";
			$curVal = trim(strval($this->id_kas->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->id_kas->AdvancedSearch->ViewValue = $this->id_kas->lookupCacheOption($curVal);
			else
				$this->id_kas->AdvancedSearch->ViewValue = $this->id_kas->Lookup !== NULL && is_array($this->id_kas->Lookup->Options) ? $curVal : NULL;
			if ($this->id_kas->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->id_kas->EditValue = array_values($this->id_kas->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->id_kas->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->id_kas->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->id_kas->EditValue = $arwrk;
			}

			// charge
			$this->charge->EditAttrs["class"] = "form-control";
			$this->charge->EditCustomAttributes = 'Readonly';
			$this->charge->EditValue = HtmlEncode($this->charge->AdvancedSearch->SearchValue);
			$this->charge->PlaceHolder = RemoveHtml($this->charge->caption());

			// klaim_poin
			$this->klaim_poin->EditAttrs["class"] = "form-control";
			$this->klaim_poin->EditCustomAttributes = "";
			$this->klaim_poin->EditValue = HtmlEncode($this->klaim_poin->AdvancedSearch->SearchValue);
			$this->klaim_poin->PlaceHolder = RemoveHtml($this->klaim_poin->caption());

			// total_penukaran_poin
			$this->total_penukaran_poin->EditAttrs["class"] = "form-control";
			$this->total_penukaran_poin->EditCustomAttributes = "Readonly";
			$this->total_penukaran_poin->EditValue = HtmlEncode($this->total_penukaran_poin->AdvancedSearch->SearchValue);
			$this->total_penukaran_poin->PlaceHolder = RemoveHtml($this->total_penukaran_poin->caption());

			// ongkir
			$this->ongkir->EditAttrs["class"] = "form-control";
			$this->ongkir->EditCustomAttributes = "";
			$this->ongkir->EditValue = HtmlEncode($this->ongkir->AdvancedSearch->SearchValue);
			$this->ongkir->PlaceHolder = RemoveHtml($this->ongkir->caption());

			// action
			$this->_action->EditAttrs["class"] = "form-control";
			$this->_action->EditCustomAttributes = "";
			if (!$this->_action->Raw)
				$this->_action->AdvancedSearch->SearchValue = HtmlDecode($this->_action->AdvancedSearch->SearchValue);
			$this->_action->EditValue = HtmlEncode($this->_action->AdvancedSearch->SearchValue);
			$this->_action->PlaceHolder = RemoveHtml($this->_action->caption());

			// status
			$this->status->EditCustomAttributes = "";
			$this->status->EditValue = $this->status->options(FALSE);

			// status_void
			$this->status_void->EditAttrs["class"] = "form-control";
			$this->status_void->EditCustomAttributes = "";
			if (!$this->status_void->Raw)
				$this->status_void->AdvancedSearch->SearchValue = HtmlDecode($this->status_void->AdvancedSearch->SearchValue);
			$this->status_void->EditValue = HtmlEncode($this->status_void->AdvancedSearch->SearchValue);
			$this->status_void->PlaceHolder = RemoveHtml($this->status_void->caption());
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

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
		if (!CheckInteger($this->id->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->id->errorMessage());
		}
		if (!CheckInteger($this->id_member->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->id_member->errorMessage());
		}
		if (!CheckEuroDate($this->waktu->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->waktu->errorMessage());
		}
		if (!CheckNumber($this->diskon_rupiah->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->diskon_rupiah->errorMessage());
		}
		if (!CheckNumber($this->ppn->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ppn->errorMessage());
		}
		if (!CheckNumber($this->total->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->total->errorMessage());
		}
		if (!CheckNumber($this->bayar->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->bayar->errorMessage());
		}
		if (!CheckNumber($this->bayar_non_tunai->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->bayar_non_tunai->errorMessage());
		}
		if (!CheckNumber($this->total_non_tunai_charge->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->total_non_tunai_charge->errorMessage());
		}
		if (!CheckInteger($this->id_rmd->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->id_rmd->errorMessage());
		}
		if (!CheckInteger($this->jumlah_voucher->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->jumlah_voucher->errorMessage());
		}
		if (!CheckNumber($this->charge->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->charge->errorMessage());
		}
		if (!CheckNumber($this->klaim_poin->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->klaim_poin->errorMessage());
		}
		if (!CheckNumber($this->total_penukaran_poin->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->total_penukaran_poin->errorMessage());
		}
		if (!CheckNumber($this->ongkir->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->ongkir->errorMessage());
		}

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
		$this->jumlah_voucher->AdvancedSearch->load();
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

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("penjualanlist.php"), "", $this->TableVar, TRUE);
		$pageId = "search";
		$Breadcrumb->add("search", $pageId, $url);
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