<?php
namespace PHPMaker2020\sim_klinik_alamanda;

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
$upload_data = new upload_data();

// Run the page
$upload_data->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
<?php
	if(isset($_POST['srhDate'])){
	 	$dateFrom = $_POST['dateFrom'];
	 	$dateTo = $_POST['dateTo'];
		$curl = curl_init();
		$curl2 = curl_init();

		// =========================================================================================================== GET JWT ====================================================
		curl_setopt_array($curl, array(
		CURLOPT_URL => "http://localhost/klinik/api/?action=login&username=admin&password=alamanda54321",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
		"Cache-Control: no-cache",
		"Content-Type: application/json"
		),
		));
		$response = curl_exec($curl);
		$chave = json_decode($response, true);
		echo "Key JWT : ".$chave['JWT'];
		echo "<hr></br>";

		$token = $chave['JWT'];

		//$data = [];
		//$sqljson = ExecuteJson("SELECT nama_klinik FROM m_klinik");
		$sql = ExecuteRows("SELECT nama_klinik FROM m_klinik");

		foreach ($sql as $value) {
			foreach ($value as $key => $value2) {
				if(!is_int($key)){
					$data2 = [
						$key => $value2
					];
					
					$xaut = "X-Authorization: Bearer ".$token;
					// echo $xaut;
					// echo "<hr></br>";
					curl_setopt_array($curl2, array(
						CURLOPT_URL => "http://localhost/klinik/api/?action=add&object=m_klinik",
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_ENCODING => "",
						CURLOPT_MAXREDIRS => 10,
						CURLOPT_TIMEOUT => 30,
						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						CURLOPT_CUSTOMREQUEST => "POST",
						CURLOPT_POSTFIELDS => http_build_query($data2),
						CURLOPT_HTTPHEADER => array(
						// "Content-Type: application/json",
						$xaut
						),
					));
					
					$response2 = curl_exec($curl2);
					
					
				}
			}
		}
		$err = curl_error($curl2);
		if ($err) {
			echo "cURL Error #:" . $err;
		} else{
			//echo "cURL Return :</br></br>";
			//$jsonObj = json_decode($response2);
			//$regs = $jsonObj->links;
			//var_dump($jsonObj);
			//echo "<hr></br>";
			//print_r($regs);
		}		
		curl_close($curl);
		curl_close($curl2);

	}

?>
<form method="post" action="<?php echo CurrentPageName() ?>">
	<!-- token itu penting buat form method post -->
	<?php if ($Page->CheckToken) { ?>
		<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
	<?php } ?>
	<div class="col-md-12">
		<h3>Upload data</h3>
		<ul class="list-unstyled">

			<!-- Date Range -->
			<li class="d-inline-block">
				<label class="d-block">From Date</label>
				<input type="date" class="form-control input-md" name="dateFrom">
			</li>
			<li class="d-inline-block">
				<label class="d-block">To Date</label>
				<input type="date" class="form-control input-md" name="dateTo">
			</li>

			<li class="d-inline-block">
				<button class="btn btn-primary btn-md p-2" type="submit" name="srhDate">
					Search 
					<i class="fa fa-search h-3"></i>
				</button>
			</li>
		</ul>
	</div>
</form>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$upload_data->terminate();
?>