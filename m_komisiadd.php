<?php
namespace PHPMaker2020\klinik_latest_08_04_21;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$m_komisi_add = new m_komisi_add();

// Run the page
$m_komisi_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_komisi_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_komisiadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fm_komisiadd = currentForm = new ew.Form("fm_komisiadd", "add");

	// Validate form
	fm_komisiadd.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($m_komisi_add->id_jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_komisi_add->id_jabatan->caption(), $m_komisi_add->id_jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fm_komisiadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_komisiadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_komisiadd.lists["x_id_jabatan"] = <?php echo $m_komisi_add->id_jabatan->Lookup->toClientList($m_komisi_add) ?>;
	fm_komisiadd.lists["x_id_jabatan"].options = <?php echo JsonEncode($m_komisi_add->id_jabatan->lookupOptions()) ?>;
	loadjs.done("fm_komisiadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_komisi_add->showPageHeader(); ?>
<?php
$m_komisi_add->showMessage();
?>
<form name="fm_komisiadd" id="fm_komisiadd" class="<?php echo $m_komisi_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_komisi">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$m_komisi_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($m_komisi_add->id_jabatan->Visible) { // id_jabatan ?>
	<div id="r_id_jabatan" class="form-group row">
		<label id="elh_m_komisi_id_jabatan" for="x_id_jabatan" class="<?php echo $m_komisi_add->LeftColumnClass ?>"><?php echo $m_komisi_add->id_jabatan->caption() ?><?php echo $m_komisi_add->id_jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_komisi_add->RightColumnClass ?>"><div <?php echo $m_komisi_add->id_jabatan->cellAttributes() ?>>
<span id="el_m_komisi_id_jabatan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_komisi" data-field="x_id_jabatan" data-value-separator="<?php echo $m_komisi_add->id_jabatan->displayValueSeparatorAttribute() ?>" id="x_id_jabatan" name="x_id_jabatan"<?php echo $m_komisi_add->id_jabatan->editAttributes() ?>>
			<?php echo $m_komisi_add->id_jabatan->selectOptionListHtml("x_id_jabatan") ?>
		</select>
</div>
<?php echo $m_komisi_add->id_jabatan->Lookup->getParamTag($m_komisi_add, "p_x_id_jabatan") ?>
</span>
<?php echo $m_komisi_add->id_jabatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if ($m_komisi->getCurrentDetailTable() != "") { ?>
<?php
	$m_komisi_add->DetailPages->ValidKeys = explode(",", $m_komisi->getCurrentDetailTable());
	$firstActiveDetailTable = $m_komisi_add->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="m_komisi_add_details"><!-- tabs -->
	<ul class="<?php echo $m_komisi_add->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
	if (in_array("m_komisi_kinerja_detail", explode(",", $m_komisi->getCurrentDetailTable())) && $m_komisi_kinerja_detail->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "m_komisi_kinerja_detail") {
			$firstActiveDetailTable = "m_komisi_kinerja_detail";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $m_komisi_add->DetailPages->pageStyle("m_komisi_kinerja_detail") ?>" href="#tab_m_komisi_kinerja_detail" data-toggle="tab"><?php echo $Language->tablePhrase("m_komisi_kinerja_detail", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("m_komisi_recall_detail", explode(",", $m_komisi->getCurrentDetailTable())) && $m_komisi_recall_detail->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "m_komisi_recall_detail") {
			$firstActiveDetailTable = "m_komisi_recall_detail";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $m_komisi_add->DetailPages->pageStyle("m_komisi_recall_detail") ?>" href="#tab_m_komisi_recall_detail" data-toggle="tab"><?php echo $Language->tablePhrase("m_komisi_recall_detail", "TblCaption") ?></a></li>
<?php
	}
?>
	</ul><!-- /.nav -->
	<div class="tab-content"><!-- .tab-content -->
<?php
	if (in_array("m_komisi_kinerja_detail", explode(",", $m_komisi->getCurrentDetailTable())) && $m_komisi_kinerja_detail->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "m_komisi_kinerja_detail")
			$firstActiveDetailTable = "m_komisi_kinerja_detail";
?>
		<div class="tab-pane <?php echo $m_komisi_add->DetailPages->pageStyle("m_komisi_kinerja_detail") ?>" id="tab_m_komisi_kinerja_detail"><!-- page* -->
<?php include_once "m_komisi_kinerja_detailgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("m_komisi_recall_detail", explode(",", $m_komisi->getCurrentDetailTable())) && $m_komisi_recall_detail->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "m_komisi_recall_detail")
			$firstActiveDetailTable = "m_komisi_recall_detail";
?>
		<div class="tab-pane <?php echo $m_komisi_add->DetailPages->pageStyle("m_komisi_recall_detail") ?>" id="tab_m_komisi_recall_detail"><!-- page* -->
<?php include_once "m_komisi_recall_detailgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
	</div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
<?php if (!$m_komisi_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_komisi_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_komisi_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_komisi_add->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$m_komisi_add->terminate();
?>