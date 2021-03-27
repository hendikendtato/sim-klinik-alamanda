<?php
namespace PHPMaker2020\klinik_latest_26_03_21;

/**
 * Page class
 */
class penjualan_add extends penjualan
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{7561FF98-88C2-4B76-B5C9-C5F11860BCF7}";

	// Table name
	public $TableName = 'penjualan';

	// Page object name
	public $PageObjName = "penjualan_add";

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
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

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
		if (Post("customexport") === NULL) {

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();
		}

		// Export
		global $penjualan;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
			if (is_array(@$_SESSION[SESSION_TEMP_IMAGES])) // Restore temp images
				$TempImages = @$_SESSION[SESSION_TEMP_IMAGES];
			if (Post("data") !== NULL)
				$content = Post("data");
			$ExportFileName = Post("filename", "");
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
	if ($this->CustomExport) { // Save temp images array for custom export
		if (is_array($TempImages))
			$_SESSION[SESSION_TEMP_IMAGES] = $TempImages;
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
					$this->terminate(GetUrl("penjualanlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->Visible = FALSE;
		$this->kode_penjualan->Visible = FALSE;
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
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("penjualanlist.php");
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
			if (Get("id") !== NULL) {
				$this->id->setQueryStringValue(Get("id"));
				$this->setKey("id", $this->id->CurrentValue); // Set up key
			} else {
				$this->setKey("id", ""); // Clear key
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
					$this->terminate("penjualanlist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = "penjualanlist.php";
					if (GetPageName($returnUrl) == "penjualanlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "penjualanview.php")
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
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->kode_penjualan->CurrentValue = NULL;
		$this->kode_penjualan->OldValue = $this->kode_penjualan->CurrentValue;
		$this->id_pelanggan->CurrentValue = NULL;
		$this->id_pelanggan->OldValue = $this->id_pelanggan->CurrentValue;
		$this->id_member->CurrentValue = NULL;
		$this->id_member->OldValue = $this->id_member->CurrentValue;
		$this->waktu->CurrentValue = NULL;
		$this->waktu->OldValue = $this->waktu->CurrentValue;
		$this->diskon_persen->CurrentValue = 0;
		$this->diskon_rupiah->CurrentValue = 0;
		$this->ppn->CurrentValue = 0;
		$this->total->CurrentValue = NULL;
		$this->total->OldValue = $this->total->CurrentValue;
		$this->bayar->CurrentValue = NULL;
		$this->bayar->OldValue = $this->bayar->CurrentValue;
		$this->bayar_non_tunai->CurrentValue = NULL;
		$this->bayar_non_tunai->OldValue = $this->bayar_non_tunai->CurrentValue;
		$this->total_non_tunai_charge->CurrentValue = NULL;
		$this->total_non_tunai_charge->OldValue = $this->total_non_tunai_charge->CurrentValue;
		$this->keterangan->CurrentValue = NULL;
		$this->keterangan->OldValue = $this->keterangan->CurrentValue;
		$this->id_klinik->CurrentValue = NULL;
		$this->id_klinik->OldValue = $this->id_klinik->CurrentValue;
		$this->id_rmd->CurrentValue = NULL;
		$this->id_rmd->OldValue = $this->id_rmd->CurrentValue;
		$this->metode_pembayaran->CurrentValue = NULL;
		$this->metode_pembayaran->OldValue = $this->metode_pembayaran->CurrentValue;
		$this->id_bank->CurrentValue = NULL;
		$this->id_bank->OldValue = $this->id_bank->CurrentValue;
		$this->id_kartu->CurrentValue = NULL;
		$this->id_kartu->OldValue = $this->id_kartu->CurrentValue;
		$this->sales->CurrentValue = NULL;
		$this->sales->OldValue = $this->sales->CurrentValue;
		$this->dok_be_wajah->CurrentValue = NULL;
		$this->dok_be_wajah->OldValue = $this->dok_be_wajah->CurrentValue;
		$this->be_body->CurrentValue = NULL;
		$this->be_body->OldValue = $this->be_body->CurrentValue;
		$this->medis->CurrentValue = NULL;
		$this->medis->OldValue = $this->medis->CurrentValue;
		$this->dokter->CurrentValue = NULL;
		$this->dokter->OldValue = $this->dokter->CurrentValue;
		$this->id_kartubank->CurrentValue = NULL;
		$this->id_kartubank->OldValue = $this->id_kartubank->CurrentValue;
		$this->id_kas->CurrentValue = NULL;
		$this->id_kas->OldValue = $this->id_kas->CurrentValue;
		$this->charge->CurrentValue = NULL;
		$this->charge->OldValue = $this->charge->CurrentValue;
		$this->klaim_poin->CurrentValue = NULL;
		$this->klaim_poin->OldValue = $this->klaim_poin->CurrentValue;
		$this->total_penukaran_poin->CurrentValue = NULL;
		$this->total_penukaran_poin->OldValue = $this->total_penukaran_poin->CurrentValue;
		$this->ongkir->CurrentValue = 0;
		$this->_action->CurrentValue = NULL;
		$this->_action->OldValue = $this->_action->CurrentValue;
		$this->status->CurrentValue = NULL;
		$this->status->OldValue = $this->status->CurrentValue;
		$this->status_void->CurrentValue = NULL;
		$this->status_void->OldValue = $this->status_void->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'id_pelanggan' first before field var 'x_id_pelanggan'
		$val = $CurrentForm->hasValue("id_pelanggan") ? $CurrentForm->getValue("id_pelanggan") : $CurrentForm->getValue("x_id_pelanggan");
		if (!$this->id_pelanggan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_pelanggan->Visible = FALSE; // Disable update for API request
			else
				$this->id_pelanggan->setFormValue($val);
		}

		// Check field name 'id_member' first before field var 'x_id_member'
		$val = $CurrentForm->hasValue("id_member") ? $CurrentForm->getValue("id_member") : $CurrentForm->getValue("x_id_member");
		if (!$this->id_member->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_member->Visible = FALSE; // Disable update for API request
			else
				$this->id_member->setFormValue($val);
		}

		// Check field name 'waktu' first before field var 'x_waktu'
		$val = $CurrentForm->hasValue("waktu") ? $CurrentForm->getValue("waktu") : $CurrentForm->getValue("x_waktu");
		if (!$this->waktu->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->waktu->Visible = FALSE; // Disable update for API request
			else
				$this->waktu->setFormValue($val);
			$this->waktu->CurrentValue = UnFormatDateTime($this->waktu->CurrentValue, 7);
		}

		// Check field name 'diskon_persen' first before field var 'x_diskon_persen'
		$val = $CurrentForm->hasValue("diskon_persen") ? $CurrentForm->getValue("diskon_persen") : $CurrentForm->getValue("x_diskon_persen");
		if (!$this->diskon_persen->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->diskon_persen->Visible = FALSE; // Disable update for API request
			else
				$this->diskon_persen->setFormValue($val);
		}

		// Check field name 'diskon_rupiah' first before field var 'x_diskon_rupiah'
		$val = $CurrentForm->hasValue("diskon_rupiah") ? $CurrentForm->getValue("diskon_rupiah") : $CurrentForm->getValue("x_diskon_rupiah");
		if (!$this->diskon_rupiah->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->diskon_rupiah->Visible = FALSE; // Disable update for API request
			else
				$this->diskon_rupiah->setFormValue($val);
		}

		// Check field name 'ppn' first before field var 'x_ppn'
		$val = $CurrentForm->hasValue("ppn") ? $CurrentForm->getValue("ppn") : $CurrentForm->getValue("x_ppn");
		if (!$this->ppn->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ppn->Visible = FALSE; // Disable update for API request
			else
				$this->ppn->setFormValue($val);
		}

		// Check field name 'total' first before field var 'x_total'
		$val = $CurrentForm->hasValue("total") ? $CurrentForm->getValue("total") : $CurrentForm->getValue("x_total");
		if (!$this->total->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->total->Visible = FALSE; // Disable update for API request
			else
				$this->total->setFormValue($val);
		}

		// Check field name 'bayar' first before field var 'x_bayar'
		$val = $CurrentForm->hasValue("bayar") ? $CurrentForm->getValue("bayar") : $CurrentForm->getValue("x_bayar");
		if (!$this->bayar->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->bayar->Visible = FALSE; // Disable update for API request
			else
				$this->bayar->setFormValue($val);
		}

		// Check field name 'bayar_non_tunai' first before field var 'x_bayar_non_tunai'
		$val = $CurrentForm->hasValue("bayar_non_tunai") ? $CurrentForm->getValue("bayar_non_tunai") : $CurrentForm->getValue("x_bayar_non_tunai");
		if (!$this->bayar_non_tunai->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->bayar_non_tunai->Visible = FALSE; // Disable update for API request
			else
				$this->bayar_non_tunai->setFormValue($val);
		}

		// Check field name 'total_non_tunai_charge' first before field var 'x_total_non_tunai_charge'
		$val = $CurrentForm->hasValue("total_non_tunai_charge") ? $CurrentForm->getValue("total_non_tunai_charge") : $CurrentForm->getValue("x_total_non_tunai_charge");
		if (!$this->total_non_tunai_charge->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->total_non_tunai_charge->Visible = FALSE; // Disable update for API request
			else
				$this->total_non_tunai_charge->setFormValue($val);
		}

		// Check field name 'keterangan' first before field var 'x_keterangan'
		$val = $CurrentForm->hasValue("keterangan") ? $CurrentForm->getValue("keterangan") : $CurrentForm->getValue("x_keterangan");
		if (!$this->keterangan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->keterangan->Visible = FALSE; // Disable update for API request
			else
				$this->keterangan->setFormValue($val);
		}

		// Check field name 'id_klinik' first before field var 'x_id_klinik'
		$val = $CurrentForm->hasValue("id_klinik") ? $CurrentForm->getValue("id_klinik") : $CurrentForm->getValue("x_id_klinik");
		if (!$this->id_klinik->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_klinik->Visible = FALSE; // Disable update for API request
			else
				$this->id_klinik->setFormValue($val);
		}

		// Check field name 'id_rmd' first before field var 'x_id_rmd'
		$val = $CurrentForm->hasValue("id_rmd") ? $CurrentForm->getValue("id_rmd") : $CurrentForm->getValue("x_id_rmd");
		if (!$this->id_rmd->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_rmd->Visible = FALSE; // Disable update for API request
			else
				$this->id_rmd->setFormValue($val);
		}

		// Check field name 'metode_pembayaran' first before field var 'x_metode_pembayaran'
		$val = $CurrentForm->hasValue("metode_pembayaran") ? $CurrentForm->getValue("metode_pembayaran") : $CurrentForm->getValue("x_metode_pembayaran");
		if (!$this->metode_pembayaran->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->metode_pembayaran->Visible = FALSE; // Disable update for API request
			else
				$this->metode_pembayaran->setFormValue($val);
		}

		// Check field name 'id_bank' first before field var 'x_id_bank'
		$val = $CurrentForm->hasValue("id_bank") ? $CurrentForm->getValue("id_bank") : $CurrentForm->getValue("x_id_bank");
		if (!$this->id_bank->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_bank->Visible = FALSE; // Disable update for API request
			else
				$this->id_bank->setFormValue($val);
		}

		// Check field name 'id_kartu' first before field var 'x_id_kartu'
		$val = $CurrentForm->hasValue("id_kartu") ? $CurrentForm->getValue("id_kartu") : $CurrentForm->getValue("x_id_kartu");
		if (!$this->id_kartu->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_kartu->Visible = FALSE; // Disable update for API request
			else
				$this->id_kartu->setFormValue($val);
		}

		// Check field name 'sales' first before field var 'x_sales'
		$val = $CurrentForm->hasValue("sales") ? $CurrentForm->getValue("sales") : $CurrentForm->getValue("x_sales");
		if (!$this->sales->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->sales->Visible = FALSE; // Disable update for API request
			else
				$this->sales->setFormValue($val);
		}

		// Check field name 'dok_be_wajah' first before field var 'x_dok_be_wajah'
		$val = $CurrentForm->hasValue("dok_be_wajah") ? $CurrentForm->getValue("dok_be_wajah") : $CurrentForm->getValue("x_dok_be_wajah");
		if (!$this->dok_be_wajah->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->dok_be_wajah->Visible = FALSE; // Disable update for API request
			else
				$this->dok_be_wajah->setFormValue($val);
		}

		// Check field name 'be_body' first before field var 'x_be_body'
		$val = $CurrentForm->hasValue("be_body") ? $CurrentForm->getValue("be_body") : $CurrentForm->getValue("x_be_body");
		if (!$this->be_body->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->be_body->Visible = FALSE; // Disable update for API request
			else
				$this->be_body->setFormValue($val);
		}

		// Check field name 'medis' first before field var 'x_medis'
		$val = $CurrentForm->hasValue("medis") ? $CurrentForm->getValue("medis") : $CurrentForm->getValue("x_medis");
		if (!$this->medis->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->medis->Visible = FALSE; // Disable update for API request
			else
				$this->medis->setFormValue($val);
		}

		// Check field name 'dokter' first before field var 'x_dokter'
		$val = $CurrentForm->hasValue("dokter") ? $CurrentForm->getValue("dokter") : $CurrentForm->getValue("x_dokter");
		if (!$this->dokter->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->dokter->Visible = FALSE; // Disable update for API request
			else
				$this->dokter->setFormValue($val);
		}

		// Check field name 'id_kartubank' first before field var 'x_id_kartubank'
		$val = $CurrentForm->hasValue("id_kartubank") ? $CurrentForm->getValue("id_kartubank") : $CurrentForm->getValue("x_id_kartubank");
		if (!$this->id_kartubank->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_kartubank->Visible = FALSE; // Disable update for API request
			else
				$this->id_kartubank->setFormValue($val);
		}

		// Check field name 'id_kas' first before field var 'x_id_kas'
		$val = $CurrentForm->hasValue("id_kas") ? $CurrentForm->getValue("id_kas") : $CurrentForm->getValue("x_id_kas");
		if (!$this->id_kas->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_kas->Visible = FALSE; // Disable update for API request
			else
				$this->id_kas->setFormValue($val);
		}

		// Check field name 'charge' first before field var 'x_charge'
		$val = $CurrentForm->hasValue("charge") ? $CurrentForm->getValue("charge") : $CurrentForm->getValue("x_charge");
		if (!$this->charge->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->charge->Visible = FALSE; // Disable update for API request
			else
				$this->charge->setFormValue($val);
		}

		// Check field name 'klaim_poin' first before field var 'x_klaim_poin'
		$val = $CurrentForm->hasValue("klaim_poin") ? $CurrentForm->getValue("klaim_poin") : $CurrentForm->getValue("x_klaim_poin");
		if (!$this->klaim_poin->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->klaim_poin->Visible = FALSE; // Disable update for API request
			else
				$this->klaim_poin->setFormValue($val);
		}

		// Check field name 'total_penukaran_poin' first before field var 'x_total_penukaran_poin'
		$val = $CurrentForm->hasValue("total_penukaran_poin") ? $CurrentForm->getValue("total_penukaran_poin") : $CurrentForm->getValue("x_total_penukaran_poin");
		if (!$this->total_penukaran_poin->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->total_penukaran_poin->Visible = FALSE; // Disable update for API request
			else
				$this->total_penukaran_poin->setFormValue($val);
		}

		// Check field name 'ongkir' first before field var 'x_ongkir'
		$val = $CurrentForm->hasValue("ongkir") ? $CurrentForm->getValue("ongkir") : $CurrentForm->getValue("x_ongkir");
		if (!$this->ongkir->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ongkir->Visible = FALSE; // Disable update for API request
			else
				$this->ongkir->setFormValue($val);
		}

		// Check field name '_action' first before field var 'x__action'
		$val = $CurrentForm->hasValue("_action") ? $CurrentForm->getValue("_action") : $CurrentForm->getValue("x__action");
		if (!$this->_action->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_action->Visible = FALSE; // Disable update for API request
			else
				$this->_action->setFormValue($val);
		}

		// Check field name 'status' first before field var 'x_status'
		$val = $CurrentForm->hasValue("status") ? $CurrentForm->getValue("status") : $CurrentForm->getValue("x_status");
		if (!$this->status->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->status->Visible = FALSE; // Disable update for API request
			else
				$this->status->setFormValue($val);
		}

		// Check field name 'status_void' first before field var 'x_status_void'
		$val = $CurrentForm->hasValue("status_void") ? $CurrentForm->getValue("status_void") : $CurrentForm->getValue("x_status_void");
		if (!$this->status_void->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->status_void->Visible = FALSE; // Disable update for API request
			else
				$this->status_void->setFormValue($val);
		}

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id_pelanggan->CurrentValue = $this->id_pelanggan->FormValue;
		$this->id_member->CurrentValue = $this->id_member->FormValue;
		$this->waktu->CurrentValue = $this->waktu->FormValue;
		$this->waktu->CurrentValue = UnFormatDateTime($this->waktu->CurrentValue, 7);
		$this->diskon_persen->CurrentValue = $this->diskon_persen->FormValue;
		$this->diskon_rupiah->CurrentValue = $this->diskon_rupiah->FormValue;
		$this->ppn->CurrentValue = $this->ppn->FormValue;
		$this->total->CurrentValue = $this->total->FormValue;
		$this->bayar->CurrentValue = $this->bayar->FormValue;
		$this->bayar_non_tunai->CurrentValue = $this->bayar_non_tunai->FormValue;
		$this->total_non_tunai_charge->CurrentValue = $this->total_non_tunai_charge->FormValue;
		$this->keterangan->CurrentValue = $this->keterangan->FormValue;
		$this->id_klinik->CurrentValue = $this->id_klinik->FormValue;
		$this->id_rmd->CurrentValue = $this->id_rmd->FormValue;
		$this->metode_pembayaran->CurrentValue = $this->metode_pembayaran->FormValue;
		$this->id_bank->CurrentValue = $this->id_bank->FormValue;
		$this->id_kartu->CurrentValue = $this->id_kartu->FormValue;
		$this->sales->CurrentValue = $this->sales->FormValue;
		$this->dok_be_wajah->CurrentValue = $this->dok_be_wajah->FormValue;
		$this->be_body->CurrentValue = $this->be_body->FormValue;
		$this->medis->CurrentValue = $this->medis->FormValue;
		$this->dokter->CurrentValue = $this->dokter->FormValue;
		$this->id_kartubank->CurrentValue = $this->id_kartubank->FormValue;
		$this->id_kas->CurrentValue = $this->id_kas->FormValue;
		$this->charge->CurrentValue = $this->charge->FormValue;
		$this->klaim_poin->CurrentValue = $this->klaim_poin->FormValue;
		$this->total_penukaran_poin->CurrentValue = $this->total_penukaran_poin->FormValue;
		$this->ongkir->CurrentValue = $this->ongkir->FormValue;
		$this->_action->CurrentValue = $this->_action->FormValue;
		$this->status->CurrentValue = $this->status->FormValue;
		$this->status_void->CurrentValue = $this->status_void->FormValue;
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
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id'] = $this->id->CurrentValue;
		$row['kode_penjualan'] = $this->kode_penjualan->CurrentValue;
		$row['id_pelanggan'] = $this->id_pelanggan->CurrentValue;
		$row['id_member'] = $this->id_member->CurrentValue;
		$row['waktu'] = $this->waktu->CurrentValue;
		$row['diskon_persen'] = $this->diskon_persen->CurrentValue;
		$row['diskon_rupiah'] = $this->diskon_rupiah->CurrentValue;
		$row['ppn'] = $this->ppn->CurrentValue;
		$row['total'] = $this->total->CurrentValue;
		$row['bayar'] = $this->bayar->CurrentValue;
		$row['bayar_non_tunai'] = $this->bayar_non_tunai->CurrentValue;
		$row['total_non_tunai_charge'] = $this->total_non_tunai_charge->CurrentValue;
		$row['keterangan'] = $this->keterangan->CurrentValue;
		$row['id_klinik'] = $this->id_klinik->CurrentValue;
		$row['id_rmd'] = $this->id_rmd->CurrentValue;
		$row['metode_pembayaran'] = $this->metode_pembayaran->CurrentValue;
		$row['id_bank'] = $this->id_bank->CurrentValue;
		$row['id_kartu'] = $this->id_kartu->CurrentValue;
		$row['sales'] = $this->sales->CurrentValue;
		$row['dok_be_wajah'] = $this->dok_be_wajah->CurrentValue;
		$row['be_body'] = $this->be_body->CurrentValue;
		$row['medis'] = $this->medis->CurrentValue;
		$row['dokter'] = $this->dokter->CurrentValue;
		$row['id_kartubank'] = $this->id_kartubank->CurrentValue;
		$row['id_kas'] = $this->id_kas->CurrentValue;
		$row['charge'] = $this->charge->CurrentValue;
		$row['klaim_poin'] = $this->klaim_poin->CurrentValue;
		$row['total_penukaran_poin'] = $this->total_penukaran_poin->CurrentValue;
		$row['ongkir'] = $this->ongkir->CurrentValue;
		$row['action'] = $this->_action->CurrentValue;
		$row['status'] = $this->status->CurrentValue;
		$row['status_void'] = $this->status_void->CurrentValue;
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
					$sqlWrk = $this->sales->Lookup->getSql(FALSE, $filterWrk, '', $this);
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
						return "`jabatan_pegawai` = 2";
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
						return "`jabatan_pegawai` = 3";
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
						return "`jabatan_pegawai` = 4";
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
						return "`jabatan_pegawai` = 1";
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
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// id_pelanggan
			$this->id_pelanggan->EditAttrs["class"] = "form-control";
			$this->id_pelanggan->EditCustomAttributes = "";
			$this->id_pelanggan->EditValue = HtmlEncode($this->id_pelanggan->CurrentValue);
			$curVal = strval($this->id_pelanggan->CurrentValue);
			if ($curVal != "") {
				$this->id_pelanggan->EditValue = $this->id_pelanggan->lookupCacheOption($curVal);
				if ($this->id_pelanggan->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id_pelanggan`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_pelanggan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$this->id_pelanggan->EditValue = $this->id_pelanggan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_pelanggan->EditValue = HtmlEncode($this->id_pelanggan->CurrentValue);
					}
				}
			} else {
				$this->id_pelanggan->EditValue = NULL;
			}
			$this->id_pelanggan->PlaceHolder = RemoveHtml($this->id_pelanggan->caption());

			// id_member
			$this->id_member->EditAttrs["class"] = "form-control";
			$this->id_member->EditCustomAttributes = "Readonly";
			$this->id_member->EditValue = HtmlEncode($this->id_member->CurrentValue);
			$curVal = strval($this->id_member->CurrentValue);
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
						$this->id_member->EditValue = HtmlEncode($this->id_member->CurrentValue);
					}
				}
			} else {
				$this->id_member->EditValue = NULL;
			}
			$this->id_member->PlaceHolder = RemoveHtml($this->id_member->caption());

			// waktu
			$this->waktu->EditAttrs["class"] = "form-control";
			$this->waktu->EditCustomAttributes = "";
			$this->waktu->EditValue = HtmlEncode(FormatDateTime($this->waktu->CurrentValue, 7));
			$this->waktu->PlaceHolder = RemoveHtml($this->waktu->caption());

			// diskon_persen
			$this->diskon_persen->EditAttrs["class"] = "form-control";
			$this->diskon_persen->EditCustomAttributes = "";
			if (!$this->diskon_persen->Raw)
				$this->diskon_persen->CurrentValue = HtmlDecode($this->diskon_persen->CurrentValue);
			$this->diskon_persen->EditValue = HtmlEncode($this->diskon_persen->CurrentValue);
			$this->diskon_persen->PlaceHolder = RemoveHtml($this->diskon_persen->caption());

			// diskon_rupiah
			$this->diskon_rupiah->EditAttrs["class"] = "form-control";
			$this->diskon_rupiah->EditCustomAttributes = "";
			$this->diskon_rupiah->EditValue = HtmlEncode($this->diskon_rupiah->CurrentValue);
			$this->diskon_rupiah->PlaceHolder = RemoveHtml($this->diskon_rupiah->caption());
			if (strval($this->diskon_rupiah->EditValue) != "" && is_numeric($this->diskon_rupiah->EditValue))
				$this->diskon_rupiah->EditValue = FormatNumber($this->diskon_rupiah->EditValue, -2, -2, -2, -2);
			

			// ppn
			$this->ppn->EditAttrs["class"] = "form-control";
			$this->ppn->EditCustomAttributes = "";
			$this->ppn->EditValue = HtmlEncode($this->ppn->CurrentValue);
			$this->ppn->PlaceHolder = RemoveHtml($this->ppn->caption());
			if (strval($this->ppn->EditValue) != "" && is_numeric($this->ppn->EditValue))
				$this->ppn->EditValue = FormatNumber($this->ppn->EditValue, -2, -2, -2, -2);
			

			// total
			$this->total->EditAttrs["class"] = "form-control";
			$this->total->EditCustomAttributes = "style='border:none; height:2em; font-size: 3em; background-color: white;' Readonly";
			$this->total->EditValue = HtmlEncode($this->total->CurrentValue);
			$this->total->PlaceHolder = RemoveHtml($this->total->caption());
			if (strval($this->total->EditValue) != "" && is_numeric($this->total->EditValue))
				$this->total->EditValue = FormatNumber($this->total->EditValue, -2, -2, -2, -2);
			

			// bayar
			$this->bayar->EditAttrs["class"] = "form-control";
			$this->bayar->EditCustomAttributes = "";
			$this->bayar->EditValue = HtmlEncode($this->bayar->CurrentValue);
			$this->bayar->PlaceHolder = RemoveHtml($this->bayar->caption());
			if (strval($this->bayar->EditValue) != "" && is_numeric($this->bayar->EditValue))
				$this->bayar->EditValue = FormatNumber($this->bayar->EditValue, -2, -2, -2, -2);
			

			// bayar_non_tunai
			$this->bayar_non_tunai->EditAttrs["class"] = "form-control";
			$this->bayar_non_tunai->EditCustomAttributes = "";
			$this->bayar_non_tunai->EditValue = HtmlEncode($this->bayar_non_tunai->CurrentValue);
			$this->bayar_non_tunai->PlaceHolder = RemoveHtml($this->bayar_non_tunai->caption());
			if (strval($this->bayar_non_tunai->EditValue) != "" && is_numeric($this->bayar_non_tunai->EditValue))
				$this->bayar_non_tunai->EditValue = FormatNumber($this->bayar_non_tunai->EditValue, -2, -2, -2, -2);
			

			// total_non_tunai_charge
			$this->total_non_tunai_charge->EditAttrs["class"] = "form-control";
			$this->total_non_tunai_charge->EditCustomAttributes = 'Readonly';
			$this->total_non_tunai_charge->EditValue = HtmlEncode($this->total_non_tunai_charge->CurrentValue);
			$this->total_non_tunai_charge->PlaceHolder = RemoveHtml($this->total_non_tunai_charge->caption());
			if (strval($this->total_non_tunai_charge->EditValue) != "" && is_numeric($this->total_non_tunai_charge->EditValue))
				$this->total_non_tunai_charge->EditValue = FormatNumber($this->total_non_tunai_charge->EditValue, -2, -2, -2, -2);
			

			// keterangan
			$this->keterangan->EditAttrs["class"] = "form-control";
			$this->keterangan->EditCustomAttributes = "";
			$this->keterangan->EditValue = HtmlEncode($this->keterangan->CurrentValue);
			$this->keterangan->PlaceHolder = RemoveHtml($this->keterangan->caption());

			// id_klinik
			$this->id_klinik->EditCustomAttributes = "";
			$curVal = trim(strval($this->id_klinik->CurrentValue));
			if ($curVal != "")
				$this->id_klinik->ViewValue = $this->id_klinik->lookupCacheOption($curVal);
			else
				$this->id_klinik->ViewValue = $this->id_klinik->Lookup !== NULL && is_array($this->id_klinik->Lookup->Options) ? $curVal : NULL;
			if ($this->id_klinik->ViewValue !== NULL) { // Load from cache
				$this->id_klinik->EditValue = array_values($this->id_klinik->Lookup->Options);
				if ($this->id_klinik->ViewValue == "")
					$this->id_klinik->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_klinik`" . SearchString("=", $this->id_klinik->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->id_klinik->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->id_klinik->ViewValue = $this->id_klinik->displayValue($arwrk);
				} else {
					$this->id_klinik->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->id_klinik->EditValue = $arwrk;
			}

			// id_rmd
			$this->id_rmd->EditAttrs["class"] = "form-control";
			$this->id_rmd->EditCustomAttributes = "";
			$this->id_rmd->EditValue = HtmlEncode($this->id_rmd->CurrentValue);
			$curVal = strval($this->id_rmd->CurrentValue);
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
						$this->id_rmd->EditValue = HtmlEncode($this->id_rmd->CurrentValue);
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
			$curVal = trim(strval($this->id_bank->CurrentValue));
			if ($curVal != "")
				$this->id_bank->ViewValue = $this->id_bank->lookupCacheOption($curVal);
			else
				$this->id_bank->ViewValue = $this->id_bank->Lookup !== NULL && is_array($this->id_bank->Lookup->Options) ? $curVal : NULL;
			if ($this->id_bank->ViewValue !== NULL) { // Load from cache
				$this->id_bank->EditValue = array_values($this->id_bank->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_rekening`" . SearchString("=", $this->id_bank->CurrentValue, DATATYPE_NUMBER, "");
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
			$curVal = trim(strval($this->id_kartu->CurrentValue));
			if ($curVal != "")
				$this->id_kartu->ViewValue = $this->id_kartu->lookupCacheOption($curVal);
			else
				$this->id_kartu->ViewValue = $this->id_kartu->Lookup !== NULL && is_array($this->id_kartu->Lookup->Options) ? $curVal : NULL;
			if ($this->id_kartu->ViewValue !== NULL) { // Load from cache
				$this->id_kartu->EditValue = array_values($this->id_kartu->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_kartu`" . SearchString("=", $this->id_kartu->CurrentValue, DATATYPE_NUMBER, "");
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

			// sales
			$this->sales->EditAttrs["class"] = "form-control";
			$this->sales->EditCustomAttributes = "";
			$curVal = trim(strval($this->sales->CurrentValue));
			if ($curVal != "")
				$this->sales->ViewValue = $this->sales->lookupCacheOption($curVal);
			else
				$this->sales->ViewValue = $this->sales->Lookup !== NULL && is_array($this->sales->Lookup->Options) ? $curVal : NULL;
			if ($this->sales->ViewValue !== NULL) { // Load from cache
				$this->sales->EditValue = array_values($this->sales->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_pegawai`" . SearchString("=", $this->sales->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->sales->Lookup->getSql(TRUE, $filterWrk, '', $this);
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
			$curVal = trim(strval($this->dok_be_wajah->CurrentValue));
			if ($curVal != "")
				$this->dok_be_wajah->ViewValue = $this->dok_be_wajah->lookupCacheOption($curVal);
			else
				$this->dok_be_wajah->ViewValue = $this->dok_be_wajah->Lookup !== NULL && is_array($this->dok_be_wajah->Lookup->Options) ? $curVal : NULL;
			if ($this->dok_be_wajah->ViewValue !== NULL) { // Load from cache
				$this->dok_be_wajah->EditValue = array_values($this->dok_be_wajah->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_pegawai`" . SearchString("=", $this->dok_be_wajah->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "`jabatan_pegawai` = 2";
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
			$curVal = trim(strval($this->be_body->CurrentValue));
			if ($curVal != "")
				$this->be_body->ViewValue = $this->be_body->lookupCacheOption($curVal);
			else
				$this->be_body->ViewValue = $this->be_body->Lookup !== NULL && is_array($this->be_body->Lookup->Options) ? $curVal : NULL;
			if ($this->be_body->ViewValue !== NULL) { // Load from cache
				$this->be_body->EditValue = array_values($this->be_body->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_pegawai`" . SearchString("=", $this->be_body->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "`jabatan_pegawai` = 3";
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
			$curVal = trim(strval($this->medis->CurrentValue));
			if ($curVal != "")
				$this->medis->ViewValue = $this->medis->lookupCacheOption($curVal);
			else
				$this->medis->ViewValue = $this->medis->Lookup !== NULL && is_array($this->medis->Lookup->Options) ? $curVal : NULL;
			if ($this->medis->ViewValue !== NULL) { // Load from cache
				$this->medis->EditValue = array_values($this->medis->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_pegawai`" . SearchString("=", $this->medis->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "`jabatan_pegawai` = 4";
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
			$curVal = trim(strval($this->dokter->CurrentValue));
			if ($curVal != "")
				$this->dokter->ViewValue = $this->dokter->lookupCacheOption($curVal);
			else
				$this->dokter->ViewValue = $this->dokter->Lookup !== NULL && is_array($this->dokter->Lookup->Options) ? $curVal : NULL;
			if ($this->dokter->ViewValue !== NULL) { // Load from cache
				$this->dokter->EditValue = array_values($this->dokter->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_pegawai`" . SearchString("=", $this->dokter->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "`jabatan_pegawai` = 1";
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
			$curVal = trim(strval($this->id_kartubank->CurrentValue));
			if ($curVal != "")
				$this->id_kartubank->ViewValue = $this->id_kartubank->lookupCacheOption($curVal);
			else
				$this->id_kartubank->ViewValue = $this->id_kartubank->Lookup !== NULL && is_array($this->id_kartubank->Lookup->Options) ? $curVal : NULL;
			if ($this->id_kartubank->ViewValue !== NULL) { // Load from cache
				$this->id_kartubank->EditValue = array_values($this->id_kartubank->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_kartu`" . SearchString("=", $this->id_kartubank->CurrentValue, DATATYPE_NUMBER, "");
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
			$curVal = trim(strval($this->id_kas->CurrentValue));
			if ($curVal != "")
				$this->id_kas->ViewValue = $this->id_kas->lookupCacheOption($curVal);
			else
				$this->id_kas->ViewValue = $this->id_kas->Lookup !== NULL && is_array($this->id_kas->Lookup->Options) ? $curVal : NULL;
			if ($this->id_kas->ViewValue !== NULL) { // Load from cache
				$this->id_kas->EditValue = array_values($this->id_kas->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->id_kas->CurrentValue, DATATYPE_NUMBER, "");
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
			$this->charge->EditValue = HtmlEncode($this->charge->CurrentValue);
			$this->charge->PlaceHolder = RemoveHtml($this->charge->caption());
			if (strval($this->charge->EditValue) != "" && is_numeric($this->charge->EditValue))
				$this->charge->EditValue = FormatNumber($this->charge->EditValue, -2, -2, -2, -2);
			

			// klaim_poin
			$this->klaim_poin->EditAttrs["class"] = "form-control";
			$this->klaim_poin->EditCustomAttributes = "";
			$this->klaim_poin->EditValue = HtmlEncode($this->klaim_poin->CurrentValue);
			$this->klaim_poin->PlaceHolder = RemoveHtml($this->klaim_poin->caption());
			if (strval($this->klaim_poin->EditValue) != "" && is_numeric($this->klaim_poin->EditValue))
				$this->klaim_poin->EditValue = FormatNumber($this->klaim_poin->EditValue, -2, -2, -2, -2);
			

			// total_penukaran_poin
			$this->total_penukaran_poin->EditAttrs["class"] = "form-control";
			$this->total_penukaran_poin->EditCustomAttributes = "Readonly";
			$this->total_penukaran_poin->EditValue = HtmlEncode($this->total_penukaran_poin->CurrentValue);
			$this->total_penukaran_poin->PlaceHolder = RemoveHtml($this->total_penukaran_poin->caption());
			if (strval($this->total_penukaran_poin->EditValue) != "" && is_numeric($this->total_penukaran_poin->EditValue))
				$this->total_penukaran_poin->EditValue = FormatNumber($this->total_penukaran_poin->EditValue, -2, -2, -2, -2);
			

			// ongkir
			$this->ongkir->EditAttrs["class"] = "form-control";
			$this->ongkir->EditCustomAttributes = "";
			$this->ongkir->EditValue = HtmlEncode($this->ongkir->CurrentValue);
			$this->ongkir->PlaceHolder = RemoveHtml($this->ongkir->caption());
			if (strval($this->ongkir->EditValue) != "" && is_numeric($this->ongkir->EditValue))
				$this->ongkir->EditValue = FormatNumber($this->ongkir->EditValue, -2, -2, -2, -2);
			

			// action
			$this->_action->EditAttrs["class"] = "form-control";
			$this->_action->EditCustomAttributes = "";
			if (!$this->_action->Raw)
				$this->_action->CurrentValue = HtmlDecode($this->_action->CurrentValue);
			$this->_action->EditValue = HtmlEncode($this->_action->CurrentValue);
			$this->_action->PlaceHolder = RemoveHtml($this->_action->caption());

			// status
			$this->status->EditCustomAttributes = "";
			$this->status->EditValue = $this->status->options(FALSE);

			// status_void
			$this->status_void->EditAttrs["class"] = "form-control";
			$this->status_void->EditCustomAttributes = "";
			if (!$this->status_void->Raw)
				$this->status_void->CurrentValue = HtmlDecode($this->status_void->CurrentValue);
			$this->status_void->EditValue = HtmlEncode($this->status_void->CurrentValue);
			$this->status_void->PlaceHolder = RemoveHtml($this->status_void->caption());

			// Add refer script
			// id_pelanggan

			$this->id_pelanggan->LinkCustomAttributes = "";
			$this->id_pelanggan->HrefValue = "";

			// id_member
			$this->id_member->LinkCustomAttributes = "";
			$this->id_member->HrefValue = "";

			// waktu
			$this->waktu->LinkCustomAttributes = "";
			$this->waktu->HrefValue = "";

			// diskon_persen
			$this->diskon_persen->LinkCustomAttributes = "";
			$this->diskon_persen->HrefValue = "";

			// diskon_rupiah
			$this->diskon_rupiah->LinkCustomAttributes = "";
			$this->diskon_rupiah->HrefValue = "";

			// ppn
			$this->ppn->LinkCustomAttributes = "";
			$this->ppn->HrefValue = "";

			// total
			$this->total->LinkCustomAttributes = "";
			$this->total->HrefValue = "";

			// bayar
			$this->bayar->LinkCustomAttributes = "";
			$this->bayar->HrefValue = "";

			// bayar_non_tunai
			$this->bayar_non_tunai->LinkCustomAttributes = "";
			$this->bayar_non_tunai->HrefValue = "";

			// total_non_tunai_charge
			$this->total_non_tunai_charge->LinkCustomAttributes = "";
			$this->total_non_tunai_charge->HrefValue = "";

			// keterangan
			$this->keterangan->LinkCustomAttributes = "";
			$this->keterangan->HrefValue = "";

			// id_klinik
			$this->id_klinik->LinkCustomAttributes = "";
			$this->id_klinik->HrefValue = "";

			// id_rmd
			$this->id_rmd->LinkCustomAttributes = "";
			$this->id_rmd->HrefValue = "";

			// metode_pembayaran
			$this->metode_pembayaran->LinkCustomAttributes = "";
			$this->metode_pembayaran->HrefValue = "";

			// id_bank
			$this->id_bank->LinkCustomAttributes = "";
			$this->id_bank->HrefValue = "";

			// id_kartu
			$this->id_kartu->LinkCustomAttributes = "";
			$this->id_kartu->HrefValue = "";

			// sales
			$this->sales->LinkCustomAttributes = "";
			$this->sales->HrefValue = "";

			// dok_be_wajah
			$this->dok_be_wajah->LinkCustomAttributes = "";
			$this->dok_be_wajah->HrefValue = "";

			// be_body
			$this->be_body->LinkCustomAttributes = "";
			$this->be_body->HrefValue = "";

			// medis
			$this->medis->LinkCustomAttributes = "";
			$this->medis->HrefValue = "";

			// dokter
			$this->dokter->LinkCustomAttributes = "";
			$this->dokter->HrefValue = "";

			// id_kartubank
			$this->id_kartubank->LinkCustomAttributes = "";
			$this->id_kartubank->HrefValue = "";

			// id_kas
			$this->id_kas->LinkCustomAttributes = "";
			$this->id_kas->HrefValue = "";

			// charge
			$this->charge->LinkCustomAttributes = "";
			$this->charge->HrefValue = "";

			// klaim_poin
			$this->klaim_poin->LinkCustomAttributes = "";
			$this->klaim_poin->HrefValue = "";

			// total_penukaran_poin
			$this->total_penukaran_poin->LinkCustomAttributes = "";
			$this->total_penukaran_poin->HrefValue = "";

			// ongkir
			$this->ongkir->LinkCustomAttributes = "";
			$this->ongkir->HrefValue = "";

			// action
			$this->_action->LinkCustomAttributes = "";
			$this->_action->HrefValue = "";

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";

			// status_void
			$this->status_void->LinkCustomAttributes = "";
			$this->status_void->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();

		// Save data for Custom Template
		if ($this->RowType == ROWTYPE_VIEW || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_ADD)
			$this->Rows[] = $this->customTemplateFieldValues();
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
		if ($this->id_pelanggan->Required) {
			if (!$this->id_pelanggan->IsDetailKey && $this->id_pelanggan->FormValue != NULL && $this->id_pelanggan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_pelanggan->caption(), $this->id_pelanggan->RequiredErrorMessage));
			}
		}
		if ($this->id_member->Required) {
			if (!$this->id_member->IsDetailKey && $this->id_member->FormValue != NULL && $this->id_member->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_member->caption(), $this->id_member->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->id_member->FormValue)) {
			AddMessage($FormError, $this->id_member->errorMessage());
		}
		if ($this->waktu->Required) {
			if (!$this->waktu->IsDetailKey && $this->waktu->FormValue != NULL && $this->waktu->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->waktu->caption(), $this->waktu->RequiredErrorMessage));
			}
		}
		if (!CheckEuroDate($this->waktu->FormValue)) {
			AddMessage($FormError, $this->waktu->errorMessage());
		}
		if ($this->diskon_persen->Required) {
			if (!$this->diskon_persen->IsDetailKey && $this->diskon_persen->FormValue != NULL && $this->diskon_persen->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->diskon_persen->caption(), $this->diskon_persen->RequiredErrorMessage));
			}
		}
		if ($this->diskon_rupiah->Required) {
			if (!$this->diskon_rupiah->IsDetailKey && $this->diskon_rupiah->FormValue != NULL && $this->diskon_rupiah->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->diskon_rupiah->caption(), $this->diskon_rupiah->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->diskon_rupiah->FormValue)) {
			AddMessage($FormError, $this->diskon_rupiah->errorMessage());
		}
		if ($this->ppn->Required) {
			if (!$this->ppn->IsDetailKey && $this->ppn->FormValue != NULL && $this->ppn->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ppn->caption(), $this->ppn->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->ppn->FormValue)) {
			AddMessage($FormError, $this->ppn->errorMessage());
		}
		if ($this->total->Required) {
			if (!$this->total->IsDetailKey && $this->total->FormValue != NULL && $this->total->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->total->caption(), $this->total->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->total->FormValue)) {
			AddMessage($FormError, $this->total->errorMessage());
		}
		if ($this->bayar->Required) {
			if (!$this->bayar->IsDetailKey && $this->bayar->FormValue != NULL && $this->bayar->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->bayar->caption(), $this->bayar->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->bayar->FormValue)) {
			AddMessage($FormError, $this->bayar->errorMessage());
		}
		if ($this->bayar_non_tunai->Required) {
			if (!$this->bayar_non_tunai->IsDetailKey && $this->bayar_non_tunai->FormValue != NULL && $this->bayar_non_tunai->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->bayar_non_tunai->caption(), $this->bayar_non_tunai->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->bayar_non_tunai->FormValue)) {
			AddMessage($FormError, $this->bayar_non_tunai->errorMessage());
		}
		if ($this->total_non_tunai_charge->Required) {
			if (!$this->total_non_tunai_charge->IsDetailKey && $this->total_non_tunai_charge->FormValue != NULL && $this->total_non_tunai_charge->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->total_non_tunai_charge->caption(), $this->total_non_tunai_charge->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->total_non_tunai_charge->FormValue)) {
			AddMessage($FormError, $this->total_non_tunai_charge->errorMessage());
		}
		if ($this->keterangan->Required) {
			if (!$this->keterangan->IsDetailKey && $this->keterangan->FormValue != NULL && $this->keterangan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->keterangan->caption(), $this->keterangan->RequiredErrorMessage));
			}
		}
		if ($this->id_klinik->Required) {
			if (!$this->id_klinik->IsDetailKey && $this->id_klinik->FormValue != NULL && $this->id_klinik->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_klinik->caption(), $this->id_klinik->RequiredErrorMessage));
			}
		}
		if ($this->id_rmd->Required) {
			if (!$this->id_rmd->IsDetailKey && $this->id_rmd->FormValue != NULL && $this->id_rmd->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_rmd->caption(), $this->id_rmd->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->id_rmd->FormValue)) {
			AddMessage($FormError, $this->id_rmd->errorMessage());
		}
		if ($this->metode_pembayaran->Required) {
			if (!$this->metode_pembayaran->IsDetailKey && $this->metode_pembayaran->FormValue != NULL && $this->metode_pembayaran->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->metode_pembayaran->caption(), $this->metode_pembayaran->RequiredErrorMessage));
			}
		}
		if ($this->id_bank->Required) {
			if (!$this->id_bank->IsDetailKey && $this->id_bank->FormValue != NULL && $this->id_bank->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_bank->caption(), $this->id_bank->RequiredErrorMessage));
			}
		}
		if ($this->id_kartu->Required) {
			if (!$this->id_kartu->IsDetailKey && $this->id_kartu->FormValue != NULL && $this->id_kartu->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_kartu->caption(), $this->id_kartu->RequiredErrorMessage));
			}
		}
		if ($this->sales->Required) {
			if (!$this->sales->IsDetailKey && $this->sales->FormValue != NULL && $this->sales->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->sales->caption(), $this->sales->RequiredErrorMessage));
			}
		}
		if ($this->dok_be_wajah->Required) {
			if (!$this->dok_be_wajah->IsDetailKey && $this->dok_be_wajah->FormValue != NULL && $this->dok_be_wajah->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->dok_be_wajah->caption(), $this->dok_be_wajah->RequiredErrorMessage));
			}
		}
		if ($this->be_body->Required) {
			if (!$this->be_body->IsDetailKey && $this->be_body->FormValue != NULL && $this->be_body->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->be_body->caption(), $this->be_body->RequiredErrorMessage));
			}
		}
		if ($this->medis->Required) {
			if (!$this->medis->IsDetailKey && $this->medis->FormValue != NULL && $this->medis->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->medis->caption(), $this->medis->RequiredErrorMessage));
			}
		}
		if ($this->dokter->Required) {
			if (!$this->dokter->IsDetailKey && $this->dokter->FormValue != NULL && $this->dokter->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->dokter->caption(), $this->dokter->RequiredErrorMessage));
			}
		}
		if ($this->id_kartubank->Required) {
			if (!$this->id_kartubank->IsDetailKey && $this->id_kartubank->FormValue != NULL && $this->id_kartubank->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_kartubank->caption(), $this->id_kartubank->RequiredErrorMessage));
			}
		}
		if ($this->id_kas->Required) {
			if (!$this->id_kas->IsDetailKey && $this->id_kas->FormValue != NULL && $this->id_kas->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_kas->caption(), $this->id_kas->RequiredErrorMessage));
			}
		}
		if ($this->charge->Required) {
			if (!$this->charge->IsDetailKey && $this->charge->FormValue != NULL && $this->charge->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->charge->caption(), $this->charge->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->charge->FormValue)) {
			AddMessage($FormError, $this->charge->errorMessage());
		}
		if ($this->klaim_poin->Required) {
			if (!$this->klaim_poin->IsDetailKey && $this->klaim_poin->FormValue != NULL && $this->klaim_poin->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->klaim_poin->caption(), $this->klaim_poin->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->klaim_poin->FormValue)) {
			AddMessage($FormError, $this->klaim_poin->errorMessage());
		}
		if ($this->total_penukaran_poin->Required) {
			if (!$this->total_penukaran_poin->IsDetailKey && $this->total_penukaran_poin->FormValue != NULL && $this->total_penukaran_poin->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->total_penukaran_poin->caption(), $this->total_penukaran_poin->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->total_penukaran_poin->FormValue)) {
			AddMessage($FormError, $this->total_penukaran_poin->errorMessage());
		}
		if ($this->ongkir->Required) {
			if (!$this->ongkir->IsDetailKey && $this->ongkir->FormValue != NULL && $this->ongkir->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ongkir->caption(), $this->ongkir->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->ongkir->FormValue)) {
			AddMessage($FormError, $this->ongkir->errorMessage());
		}
		if ($this->_action->Required) {
			if (!$this->_action->IsDetailKey && $this->_action->FormValue != NULL && $this->_action->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_action->caption(), $this->_action->RequiredErrorMessage));
			}
		}
		if ($this->status->Required) {
			if ($this->status->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
			}
		}
		if ($this->status_void->Required) {
			if (!$this->status_void->IsDetailKey && $this->status_void->FormValue != NULL && $this->status_void->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->status_void->caption(), $this->status_void->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("detailpenjualan", $detailTblVar) && $GLOBALS["detailpenjualan"]->DetailAdd) {
			if (!isset($GLOBALS["detailpenjualan_grid"]))
				$GLOBALS["detailpenjualan_grid"] = new detailpenjualan_grid(); // Get detail page object
			$GLOBALS["detailpenjualan_grid"]->validateGridForm();
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

		// id_pelanggan
		$this->id_pelanggan->setDbValueDef($rsnew, $this->id_pelanggan->CurrentValue, 0, FALSE);

		// id_member
		$this->id_member->setDbValueDef($rsnew, $this->id_member->CurrentValue, NULL, FALSE);

		// waktu
		$this->waktu->setDbValueDef($rsnew, UnFormatDateTime($this->waktu->CurrentValue, 7), CurrentDate(), FALSE);

		// diskon_persen
		$this->diskon_persen->setDbValueDef($rsnew, $this->diskon_persen->CurrentValue, "", FALSE);

		// diskon_rupiah
		$this->diskon_rupiah->setDbValueDef($rsnew, $this->diskon_rupiah->CurrentValue, 0, FALSE);

		// ppn
		$this->ppn->setDbValueDef($rsnew, $this->ppn->CurrentValue, 0, FALSE);

		// total
		$this->total->setDbValueDef($rsnew, $this->total->CurrentValue, 0, FALSE);

		// bayar
		$this->bayar->setDbValueDef($rsnew, $this->bayar->CurrentValue, 0, FALSE);

		// bayar_non_tunai
		$this->bayar_non_tunai->setDbValueDef($rsnew, $this->bayar_non_tunai->CurrentValue, 0, FALSE);

		// total_non_tunai_charge
		$this->total_non_tunai_charge->setDbValueDef($rsnew, $this->total_non_tunai_charge->CurrentValue, 0, FALSE);

		// keterangan
		$this->keterangan->setDbValueDef($rsnew, $this->keterangan->CurrentValue, NULL, FALSE);

		// id_klinik
		$this->id_klinik->setDbValueDef($rsnew, $this->id_klinik->CurrentValue, NULL, FALSE);

		// id_rmd
		$this->id_rmd->setDbValueDef($rsnew, $this->id_rmd->CurrentValue, NULL, FALSE);

		// metode_pembayaran
		$this->metode_pembayaran->setDbValueDef($rsnew, $this->metode_pembayaran->CurrentValue, "", FALSE);

		// id_bank
		$this->id_bank->setDbValueDef($rsnew, $this->id_bank->CurrentValue, 0, FALSE);

		// id_kartu
		$this->id_kartu->setDbValueDef($rsnew, $this->id_kartu->CurrentValue, NULL, FALSE);

		// sales
		$this->sales->setDbValueDef($rsnew, $this->sales->CurrentValue, NULL, FALSE);

		// dok_be_wajah
		$this->dok_be_wajah->setDbValueDef($rsnew, $this->dok_be_wajah->CurrentValue, NULL, FALSE);

		// be_body
		$this->be_body->setDbValueDef($rsnew, $this->be_body->CurrentValue, NULL, FALSE);

		// medis
		$this->medis->setDbValueDef($rsnew, $this->medis->CurrentValue, NULL, FALSE);

		// dokter
		$this->dokter->setDbValueDef($rsnew, $this->dokter->CurrentValue, NULL, FALSE);

		// id_kartubank
		$this->id_kartubank->setDbValueDef($rsnew, $this->id_kartubank->CurrentValue, 0, FALSE);

		// id_kas
		$this->id_kas->setDbValueDef($rsnew, $this->id_kas->CurrentValue, 0, FALSE);

		// charge
		$this->charge->setDbValueDef($rsnew, $this->charge->CurrentValue, NULL, FALSE);

		// klaim_poin
		$this->klaim_poin->setDbValueDef($rsnew, $this->klaim_poin->CurrentValue, NULL, FALSE);

		// total_penukaran_poin
		$this->total_penukaran_poin->setDbValueDef($rsnew, $this->total_penukaran_poin->CurrentValue, NULL, FALSE);

		// ongkir
		$this->ongkir->setDbValueDef($rsnew, $this->ongkir->CurrentValue, NULL, FALSE);

		// action
		$this->_action->setDbValueDef($rsnew, $this->_action->CurrentValue, NULL, FALSE);

		// status
		$this->status->setDbValueDef($rsnew, $this->status->CurrentValue, "", FALSE);

		// status_void
		$this->status_void->setDbValueDef($rsnew, $this->status_void->CurrentValue, NULL, FALSE);

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
			if (in_array("detailpenjualan", $detailTblVar) && $GLOBALS["detailpenjualan"]->DetailAdd) {
				$GLOBALS["detailpenjualan"]->id_penjualan->setSessionValue($this->id->CurrentValue); // Set master key
				if (!isset($GLOBALS["detailpenjualan_grid"]))
					$GLOBALS["detailpenjualan_grid"] = new detailpenjualan_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "detailpenjualan"); // Load user level of detail table
				$addRow = $GLOBALS["detailpenjualan_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["detailpenjualan"]->id_penjualan->setSessionValue(""); // Clear master key if insert failed
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
			if (in_array("detailpenjualan", $detailTblVar)) {
				if (!isset($GLOBALS["detailpenjualan_grid"]))
					$GLOBALS["detailpenjualan_grid"] = new detailpenjualan_grid();
				if ($GLOBALS["detailpenjualan_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["detailpenjualan_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["detailpenjualan_grid"]->CurrentMode = "add";
					$GLOBALS["detailpenjualan_grid"]->CurrentAction = "gridadd";

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
					break;
				case "x_dok_be_wajah":
					$lookupFilter = function() {
						return "`jabatan_pegawai` = 2";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_be_body":
					$lookupFilter = function() {
						return "`jabatan_pegawai` = 3";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_medis":
					$lookupFilter = function() {
						return "`jabatan_pegawai` = 4";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_dokter":
					$lookupFilter = function() {
						return "`jabatan_pegawai` = 1";
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

		$status = $this->status->CurrentValue;
		$id = $this->id->CurrentValue;
		$session = $_SESSION["id_penjualan"];

		//var_dump($session); exit();
		if ($this->IsInsert()) {
			$pid_penjualan = ExecuteScalar("SELECT id_penjualan FROM detailpenjualan WHERE id_penjualan = $id");

			//var_dump($session); exit();	
			if($pid_penjualan != NULL OR $pid_penjualan != FALSE){
				if($status == "Printed"){	
					$url = "struk_belanja.php?id=$id";
				}
			}
		}
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
		$pegawai = CurrentUserInfo("id_pegawai");
		if($pegawai != '' OR $pegawai != FALSE){
			$this->sales->CurrentValue = $pegawai;
			$this->sales->ReadOnly = TRUE; 
		}
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