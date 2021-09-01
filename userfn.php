<?php
namespace PHPMaker2020\sim_klinik_alamanda;
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

		Execute("INSERT INTO antrian (tanggal, nomor_antrian, selesai, keperluan, nama_klinik) VALUES ('$date', '$nomor_antrian', 'belum', 'Konsultasi', '$cabang')");
		$data['success'] = true;				
	} catch (Exception $e) {
		$data['success'] = false;
	}
	print_r($data);
	exit();
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

//API datapenjualan
$API_ACTIONS["dataPenjualan"] = function(Request $request, Response &$response) {
	try {
	$data_penjualan = ExecuteRows("SELECT * FROM penjualan");
		if(empty($data_penjualan)){
			$data['success'] = false;
			$data['message'] = "Tidak Ada Data!";
		} else {
			$data['success'] = true;
			$data['data']    =  $data_penjeualan;
		}
	} catch (Exception $e) {
		$data['success'] = false;
		$data['message'] = $e;
	}
	WriteJson($data);
};

//API detailpenjualan
$API_ACTIONS["dataDetailPenjualan"] = function(Request $request, Response &$response) {
	try {
	$data_penjualan = ExecuteRows("SELECT * FROM detailpenjualan");
		if(empty($data_penjualan)){
			$data['success'] = false;
			$data['message'] = "Tidak Ada Data!";
		} else {
			$data['success'] = true;
			$data['data']    = $data_penjualan;
		}
	} catch (Exception $e) {
		$data['success'] = false;
		$data['message'] = $e;
	}
	WriteJson($data);
};

//API barang
$API_ACTIONS["dataBarang"] = function(Request $request, Response &$response) {
	try {
	$data_barang = ExecuteRows("SELECT * FROM m_barang");
		if(empty($data_barang)){
			$data['success'] = false;
			$data['message'] = "Tidak Ada Data!";
		} else {
			$data['success'] = true;
			$data['data']    = $data_barang;
		}
	} catch (Exception $e) {
		$data['success'] = false;
		$data['message'] = $e;
	}
	WriteJson($data);
};

//API stokhargajual
$API_ACTIONS["stokHargaJual"] = function(Request $request, Response &$response) {
	try {
	$data_hargajual = ExecuteRows("SELECT * FROM m_hargajual");
		if(empty($data_hargajual)){
			$data['success'] = false;
			$data['message'] = "Tidak Ada Data!";
		} else {
			$data['success'] = true;
			$data['data']    = $data_hargajual;
		}
	} catch (Exception $e) {
		$data['success'] = false;
		$data['message'] = $e;
	}
	WriteJson($data);
};

//API pelanggan
$API_ACTIONS["dataPelanggan"] = function(Request $request, Response &$response) {
	try {
	$data_pelanggan = ExecuteRows("SELECT * FROM m_pelanggan");
		if(empty($data_pelanggan)){
			$data['success'] = false;
			$data['message'] = "Tidak Ada Data!";
		} else {
			$data['success'] = true;
			$data['data']    = $data_pelanggan;
		}
	} catch (Exception $e) {
		$data['success'] = false;
		$data['message'] = $e;
	}
	WriteJson($data);
};

//API cabang
$API_ACTIONS["dataKlinik"] = function(Request $request, Response &$response) {
	try {
	$data_cabang = ExecuteRows("SELECT * FROM m_klinik");
		if(empty($data_cabang)){
			$data['success'] = false;
			$data['message'] = "Tidak Ada Data!";
		} else {
			$data['success'] = true;
			$data['data']    = $data_cabang;
		}
	} catch (Exception $e) {
		$data['success'] = false;
		$data['message'] = $e;
	}
	WriteJson($data);
};

//Get stok ketika penyesuaian stok tanggal sebelumnya
$API_ACTIONS["getStokAkhir"] = function(Request $request, Response $response) {
	 $id_barang = Param("id_barang"); // Get the input value from $_GET or $_POST
	 $id_klinik = Param("id_klinik");
	 $tanggal = Param("tanggal");
	 $stok_sebelumnya = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang' AND id_klinik = '$id_klinik' AND tanggal < '$tanggal' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");  // Output field value as string
	 if($stok_sebelumnya != null OR $stok_sebelumnya != false) {
	 	Write($stok_sebelumnya);
	 } else {
	 	$stok_setelahnya = ExecuteScalar("SELECT stok_awal FROM kartustok WHERE id_barang = '$id_barang' AND id_klinik = '$id_klinik' AND tanggal > '$tanggal' ORDER BY tanggal ASC, id_kartustok ASC LIMIT 1");  // Output field value as string
	 	if($stok_setelahnya != null OR $stok_setelahnya != false) {
	 		Write($stok_setelahnya);	 		
	 	} else {
	 		Write(ExecuteScalar("SELECT stok FROM m_hargajual WHERE id_barang = '$id_barang' AND id_klinik = '$id_klinik'"));  // Output field value as string
	 	}
	 }
};

//Get stok ketika penyesuaian stok tanggal sekarang
$API_ACTIONS["getStok"] = function(Request $request, Response $response) {
	 $id_barang = Param("id_barang"); // Get the input value from $_GET or $_POST
	 $id_klinik = Param("id_klinik");
	 Write(ExecuteScalar("SELECT stok FROM m_hargajual WHERE id_barang = '$id_barang' AND id_klinik = '$id_klinik'"));  // Output field value as string
};

//Get target omset cabang
$API_ACTIONS["dataOmsetCabang"] = function(Request $request, Response &$response) {
	$id_klinik = Param("id_klinik");
	$bulan = DATE('m');
	$tahun = DATE('Y');
	try {
	$data_target = ExecuteRow("SELECT * FROM m_target_omset_cabang JOIN m_klinik ON m_klinik.id_klinik = m_target_omset_cabang.id_cabang WHERE MONTH(m_target_omset_cabang.tgl_awal) = '$bulan' AND YEAR(m_target_omset_cabang.tgl_awal) = '$tahun' AND m_target_omset_cabang.id_cabang='$id_klinik'");
	$aktual = ExecuteScalar("SELECT SUM(total) FROM penjualan WHERE MONTH(waktu) = '$bulan' AND YEAR(waktu) = '$tahun' AND id_klinik = '$id_klinik' AND status != 'Draft'");
	array_push($data_target, $aktual);
	if(empty($data_target)){
			$data['success'] = false;
			$data['message'] = "Tidak Ada Data!";
		} else {
			$data['success'] = true;
			$data['data']    = $data_target;
		}
	} catch (Exception $e) {
		$data['success'] = false;
		$data['message'] = $e;
	}
	WriteJson($data);
};

//Get data omset pasien
$API_ACTIONS["dataOmsetPasien"] = function(Request $request, Response &$response) {
	$id_klinik = Param("id_klinik");
	$bulan = DATE('m');
	$tahun = DATE('Y');
	try {
	$total_pasien = ExecuteRow("SELECT COUNT(DISTINCT(id_pelanggan)) AS total_pelanggan, id_klinik FROM penjualan WHERE id_klinik = '$id_klinik' AND MONTH(waktu) = '$bulan' AND YEAR(waktu) = '$tahun'");
	$target_pasien = ExecuteScalar("SELECT target FROM m_target_pasien WHERE id_cabang = '$id_klinik' AND MONTH(tgl_awal) = '$bulan' AND YEAR(tgl_awal) = '$tahun'");
	array_push($total_pasien, $target_pasien);
	if(empty($total_pasien)){
			$data['success'] = false;
			$data['message'] = "Tidak Ada Data!";
		} else {
			$data['success'] = true;
			$data['data']    = $total_pasien;
		}
	} catch (Exception $e) {
		$data['success'] = false;
		$data['message'] = $e;
	}
	WriteJson($data);
};

//Get data target pasien baru
$API_ACTIONS["dataOmsetPasienBaru"] = function(Request $request, Response &$response) {
	$id_klinik = Param("id_klinik");
	$bulan = DATE('m');
	$tahun = DATE('Y');
	try {
	$total_pasien_baru = ExecuteRow("SELECT COUNT(DISTINCT(penjualan.id_pelanggan)) AS total_pelanggan_baru, penjualan.id_klinik FROM penjualan JOIN m_pelanggan ON m_pelanggan.id_pelanggan = penjualan.id_pelanggan WHERE penjualan.id_klinik = '$id_klinik' AND MONTH(penjualan.waktu) = '$bulan' AND YEAR(penjualan.waktu) = '$tahun' AND MONTH(m_pelanggan.tgl_daftar) = '$bulan' AND YEAR(m_pelanggan.tgl_daftar) = '$tahun'");
	$target_pasien_baru = ExecuteScalar("SELECT target FROM m_target_pasien_baru WHERE id_cabang = '$id_klinik' AND MONTH(tgl_awal) = '$bulan' AND YEAR(tgl_awal) = '$tahun'");
	array_push($total_pasien_baru, $target_pasien_baru);
	if(empty($total_pasien_baru)){
			$data['success'] = false;
			$data['message'] = "Tidak Ada Data!";
		} else {
			$data['success'] = true;
			$data['data']    = $total_pasien_baru;
		}
	} catch (Exception $e) {
		$data['success'] = false;
		$data['message'] = $e;
	}
	WriteJson($data);
};

//Get data target kunjungan
$API_ACTIONS["dataOmsetKunjungan"] = function(Request $request, Response &$response) {
	$id_klinik = Param("id_klinik");
	$bulan = DATE('m');
	$tahun = DATE('Y');
	try {
	$total_nota = ExecuteRow("SELECT COUNT(kode_penjualan) AS total_nota, id_klinik FROM penjualan WHERE id_klinik = '$id_klinik' AND MONTH(waktu) = '$bulan' AND YEAR(waktu) = '$tahun' AND status != 'Draft'");
	$target_nota = ExecuteRow("SELECT target FROM m_target_kunjungan WHERE id_cabang = '$id_klinik' AND MONTH(tgl_awal) = '$bulan' AND YEAR(tgl_awal) = '$tahun'");
	array_push($total_nota, $target_nota);
	if(empty($total_nota)){
			$data['success'] = false;
			$data['message'] = "Tidak Ada Data!";
		} else {
			$data['success'] = true;
			$data['data']    = $total_nota;
		}
	} catch (Exception $e) {
		$data['success'] = false;
		$data['message'] = $e;
	}
	WriteJson($data);
};

//Get data target produk terjual
$API_ACTIONS["dataOmsetProduk"] = function(Request $request, Response &$response) {
	$id_klinik = Param("id_klinik");
	$bulan = DATE('m');
	$tahun = DATE('Y');
	try {
	$produk_terjual = ExecuteRows("SELECT m_target_produk.target, m_status_barang.id_status, m_status_barang.status_barang ,SUM(detailpenjualan.qty) AS qty FROM penjualan 
	JOIN detailpenjualan ON penjualan.id = detailpenjualan.id_penjualan
	JOIN m_hargajual ON m_hargajual.id_barang = detailpenjualan.id_barang
		AND m_hargajual.id_klinik = '$id_klinik'
	JOIN m_status_barang ON m_hargajual.status = m_status_barang.id_status
	JOIN m_barang ON detailpenjualan.id_barang = m_barang.id
	LEFT JOIN m_target_produk ON m_target_produk.status LIKE CONCAT ('%', m_status_barang.id_status, '%')
		AND m_target_produk.id_cabang = '$id_klinik'
		AND MONTH(m_target_produk.tgl_awal) = '$bulan'
		AND YEAR(m_target_produk.tgl_akhir) = '$tahun'	
	WHERE MONTH(penjualan.waktu) = '$bulan' AND YEAR(penjualan.waktu) = '$tahun' AND m_barang.tipe != 'Perawatan' AND penjualan.id_klinik = '$id_klinik' GROUP BY m_hargajual.status");
	if(empty($produk_terjual)){
			$data['success'] = false;
			$data['message'] = "Tidak Ada Data!";
		} else {
			$data['success'] = true;
			$data['data']    = $produk_terjual;
		}
	} catch (Exception $e) {
		$data['success'] = false;
		$data['message'] = $e;
	}
	WriteJson($data);
};

//Get data target perawatan terjual
$API_ACTIONS["dataOmsetPerawatan"] = function(Request $request, Response &$response) {
	$id_klinik = Param("id_klinik");
	$bulan = DATE('m');
	$tahun = DATE('Y');
	try {
	$perawatan_terjual = ExecuteRows("SELECT m_target_perawatan.target,jenisbarang.id, jenisbarang.jenis ,SUM(detailpenjualan.qty) AS qty FROM penjualan 
	JOIN detailpenjualan ON penjualan.id = detailpenjualan.id_penjualan
	JOIN m_barang ON detailpenjualan.id_barang = m_barang.id
	JOIN jenisbarang ON jenisbarang.id = m_barang.jenis
	LEFT JOIN m_target_perawatan ON m_target_perawatan.jenis LIKE CONCAT ('%', m_barang.jenis, '%')
		AND m_target_perawatan.id_cabang = '$id_klinik'
		AND MONTH(m_target_perawatan.tgl_awal) = '$bulan'
		AND YEAR(m_target_perawatan.tgl_akhir) = '$tahun'
	WHERE MONTH(penjualan.waktu) = '$bulan' AND YEAR(penjualan.waktu) = '$tahun' AND m_barang.tipe = 'Perawatan' AND penjualan.id_klinik = '$id_klinik' GROUP BY m_barang.jenis");
	if(empty($perawatan_terjual)){
			$data['success'] = false;
			$data['message'] = "Tidak Ada Data!";
		} else {
			$data['success'] = true;
			$data['data']    = $perawatan_terjual;
		}
	} catch (Exception $e) {
		$data['success'] = false;
		$data['message'] = $e;
	}
	WriteJson($data);
};
?>