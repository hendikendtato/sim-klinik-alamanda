<?php
namespace PHPMaker2020\klinik_latest_09_04_21;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Filter for 'Last Month' (example)
function GetLastMonthFilter($FldExpression, $dbid = 0) {
	$today = getdate();
	$lastmonth = mktime(0, 0, 0, $today['mon']-1, 1, $today['year']);
	$val = date("Y|m", $lastmonth);
	$wrk = $FldExpression . " BETWEEN " .
		QuotedValue(DateValue("month", $val, 1, $dbid), DATATYPE_DATE, $dbid) .
		" AND " .
		QuotedValue(DateValue("month", $val, 2, $dbid), DATATYPE_DATE, $dbid);
	return $wrk;
}

// Filter for 'Starts With A' (example)
function GetStartsWithAFilter($FldExpression, $dbid = 0) {
	return $FldExpression . Like("'A%'", $dbid);
}

// Global user functions
// Database Connecting event
function Database_Connecting(&$info) {

	// Example:
	//var_dump($info);
	//if ($info["id"] == "DB" && CurrentUserIP() == "127.0.0.1") { // Testing on local PC
	//	$info["host"] = "locahost";
	//	$info["user"] = "root";
	//	$info["pass"] = "";
	//}

	if ($_SERVER['SERVER_NAME'] != "localhost") {
		$info["host"] = "localhost";
		$info["user"] = "root";
		$info["pass"] = "alamanda";
		$info["port"] = "14044";
		$info["db"] = "si_klinik_alamanda";
	}
}

// Database Connected event
function Database_Connected(&$conn) {

	// Example:
	//if ($conn->info["id"] == "DB")
	//	$conn->Execute("Your SQL");

}

function MenuItem_Adding($item) {

	//var_dump($item);
	// Return FALSE if menu item not allowed

	return TRUE;
}

function Menu_Rendering($menu) {

	// Change menu items here
}

function Menu_Rendered($menu) {

	// Clean up here
}

// Page Loading event
function Page_Loading() {

	//echo "Page Loading";
}

// Page Rendering event
function Page_Rendering() {

	//echo "Page Rendering";
}

// Page Unloaded event
function Page_Unloaded() {

	//echo "Page Unloaded";
}

// AuditTrail Inserting event
function AuditTrail_Inserting(&$rsnew) {

	//var_dump($rsnew);
	return TRUE;
}

// Personal Data Downloading event
function PersonalData_Downloading(&$row) {

	//echo "PersonalData Downloading";
}

// Personal Data Deleted event
function PersonalData_Deleted($row) {

	//echo "PersonalData Deleted";
}
$API_ACTIONS["checkPelangganStatus"] = function(Request $request, Response &$response) {
	set_time_limit(0); 
	try {
		$dataPelanggan = ExecuteRows("SELECT * FROM m_pelanggan");
		$dataTipePelanggan = ExecuteRows("SELECT * FROM m_tipepelanggan");
		foreach($dataPelanggan as $pelanggan){
			$curdate = time();
			$tgl_daftar = strtotime($pelanggan['tgl_daftar']);
			$datediff = $curdate - $tgl_daftar;
			$tanggal_lama_pelanggan  = round($datediff / (60 * 60 * 24));
			$idPelanggan = $pelanggan['id_pelanggan'];
			foreach($dataTipePelanggan as $tipepelanggan){
				if($tanggal_lama_pelanggan >= $tipepelanggan['periode']){
					$periodePelanggan = $tipepelanggan['periode'];
					$dataPenjualan = ExecuteRow("SELECT COUNT(id) AS total_transaksi FROM penjualan
		 											WHERE id_pelanggan = $idPelanggan AND
		 											( waktu BETWEEN SUBDATE(CURDATE(), INTERVAL $periodePelanggan DAY) AND CURDATE() )
		 	 									");					
					$total_transaksi = 0;
					if(!empty($dataPenjualan['total_transaksi'])){
						$total_transaksi = $dataPenjualan['total_transaksi'];
					}
					if($total_transaksi >= $tipepelanggan['min_kedatangan']){
						$tipePelangganBaru = $tipepelanggan['id_tipe'];						
						Execute("UPDATE m_pelanggan SET tipe = $tipePelangganBaru WHERE id_pelanggan = $idPelanggan");
						break;
					}
				}
			}
		}	
		Execute("INSERT INTO log_checkpelanggan SET tglwaktu_update = NOW(), tgl_update = CURDATE()");
		$data['success'] = true;
		$data['message'] = "Berhasil Mengecek Pelanggan";				
	} catch (Exception $e) {
		$data['success'] = false;
		$data['message'] = $e;
	}
	WriteJson($data);
};
$API_ACTIONS["checkBulanan"] = function(Request $request, Response &$response) {
	try {
		$dataCheckBulanan = ExecuteRow("SELECT tglwaktu_update FROM log_checkpelanggan WHERE tgl_update = CURDATE()");
		if(empty($dataCheckBulanan)){
			$data['success'] = true;
			$data['message'] = "Untuk Hari Ini Belum Ada Pengecekan";
			$data['data']    =  $dataCheckBulanan;
			$data['isChecked'] = false;
		}else{
			$data['success'] = true;
			$data['message'] = "Untuk Hari Ini Sudah Ada Pengecekan";
			$data['data']    =  $dataCheckBulanan;
			$data['isChecked'] = true;
		}
	} catch (Exception $e) {
		$data['success'] = false;
		$data['message'] = $e;
	}
	WriteJson($data);
};
$API_ACTIONS["getJenisMember"] = function(Request $request, Response &$response) {
	try {
		$idJenisMember = Param("id_jenis_member", Route(1));
		$dataJenisMember = ExecuteRow("SELECT * FROM m_jenis_member WHERE id_jenis_member = $idJenisMember");
		if(empty($dataJenisMember)){
			$data['success'] = true;
			$data['message'] = "No Problem";
			$data['data']    =  $datJenisMember;
		}else{
			$data['success'] = true;
			$data['message'] = "Data Kosong";
			$data['data']    =  $dataJenisMember;
		}
	} catch (Exception $e) {
		$data['success'] = false;
		$data['message'] = $e;
	}
	WriteJson($data);
};
$API_ACTIONS["postActionBeli"] = function(Request $request, Response &$response) {
	try {
	$cabang = Param("nama_klinik", Route(1));
	$kode_antrian_sebelumnya = ExecuteScalar("SELECT nomor_antrian FROM antrian WHERE keperluan='Beli Produk' AND nama_klinik='$cabang' ORDER BY id DESC");
	$kode = explode('-', $kode_antrian_sebelumnya);
	$nomor_urut_terakhir = substr($kode[2], -4);
	$hari_sebelumnya = $kode[1];
	$nomor_urut = '0000';
	if ($hari_sebelumnya == date('d')) {
		$nomor_urut = sprintf('%04d', (int)$nomor_urut_terakhir + 1);
	} else {
		$nomor_urut = sprintf('%04d', 1);
	}

	/* kode penjualan dengan format Jxx-yymm-0000
	 * J = jual
	 *	xx = kode cabang
	 *	yy = tahun
	 *	mm = bulan
	 *	0000 = nmr urut
	*/
	$nomor_antrian = 'B' . '-' . date('d') . '-' . $nomor_urut;
	$date = date('Y-m-d');

		//$cabang = Param("nama_klinik", Route(1));
		//$nama_cabang = ExecuteScalar("SELECT nama_klinik FROM m_klinik WHERE nama_klinik = $cabang");

		Execute("INSERT INTO antrian SET tanggal = '$date', nomor_antrian = '$nomor_antrian', selesai = 'belum', keperluan = 'Beli Produk', nama_klinik='$cabang'");
		$data['success'] = true;				
	} catch (Exception $e) {
		$data['success'] = false;
	}
	WriteJson($data);
};
$API_ACTIONS["postActionKonsultasi"] = function(Request $request, Response &$response) {
	try {
	$cabang = Param("nama_klinik", Route(1));
	$kode_antrian_sebelumnya = ExecuteScalar("SELECT nomor_antrian FROM antrian WHERE keperluan='Konsultasi' AND nama_klinik='$cabang' ORDER BY id DESC");
	$kode = explode('-', $kode_antrian_sebelumnya);
	$nomor_urut_terakhir = substr($kode[2], -4);
	$hari_sebelumnya = $kode[1];
	$nomor_urut = '0000';
	if ($hari_sebelumnya == date('d')) {
		$nomor_urut = sprintf('%04d', (int)$nomor_urut_terakhir + 1);
	} else {
		$nomor_urut = sprintf('%04d', 1);
	}

	/* kode penjualan dengan format Jxx-yymm-0000
	 * J = jual
	 *	xx = kode cabang
	 *	yy = tahun
	 *	mm = bulan
	 *	0000 = nmr urut
	*/
	$nomor_antrian = 'K' . '-' . date('d') . '-' . $nomor_urut;
	$date = date('Y-m-d');

		//$cabang = Param("nama_klinik", Route(1));
		//$nama_cabang = ExecuteScalar("SELECT nama_klinik FROM m_klinik WHERE nama_klinik = $cabang");

		Execute("INSERT INTO antrian SET tanggal = '$date', nomor_antrian = '$nomor_antrian', selesai = 'belum', keperluan = 'Konsultasi', nama_klinik='$cabang'");
		$data['success'] = true;				
	} catch (Exception $e) {
		$data['success'] = false;
	}
	WriteJson($data);
};
$API_ACTIONS["postActionPerawatan"] = function(Request $request, Response &$response) {
	try {
	$cabang = Param("nama_klinik", Route(1));
	$kode_antrian_sebelumnya = ExecuteScalar("SELECT nomor_antrian FROM antrian WHERE keperluan='Perawatan' AND nama_klinik='$cabang' ORDER BY id DESC");
	$kode = explode('-', $kode_antrian_sebelumnya);
	$nomor_urut_terakhir = substr($kode[2], -4);
	$hari_sebelumnya = $kode[1];
	$nomor_urut = '0000';
	if ($hari_sebelumnya == date('d')) {
		$nomor_urut = sprintf('%04d', (int)$nomor_urut_terakhir + 1);
	} else {
		$nomor_urut = sprintf('%04d', 1);
	}

	/* kode penjualan dengan format Jxx-yymm-0000
	 * J = jual
	 *	xx = kode cabang
	 *	yy = tahun
	 *	mm = bulan
	 *	0000 = nmr urut
	*/
	$nomor_antrian = 'P' . '-' . date('d') . '-' . $nomor_urut;
	$date = date('Y-m-d');

		//$cabang = Param("nama_klinik", Route(1));
		//$nama_cabang = ExecuteScalar("SELECT nama_klinik FROM m_klinik WHERE nama_klinik = $cabang");

		Execute("INSERT INTO antrian SET tanggal = '$date', nomor_antrian = '$nomor_antrian', selesai = 'belum', keperluan = 'Perawatan', nama_klinik='$cabang'");
		$data['success'] = true;				
	} catch (Exception $e) {
		$data['success'] = false;
	}
	WriteJson($data);
};
?>