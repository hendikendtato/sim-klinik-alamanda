<?php
namespace PHPMaker2020\klinik_latest_09_04_21;

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
$struk_belanja = new struk_belanja();

// Run the page
$struk_belanja->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
<?php
	$id_penjualan = Get("id");

	$penjualan = "SELECT * FROM penjualan WHERE penjualan.id='$id_penjualan'";
	$nama = "SELECT nama_pelanggan FROM m_pelanggan INNER JOIN penjualan ON m_pelanggan.id_pelanggan = penjualan.id_pelanggan WHERE id='$id_penjualan'";

	$result = ExecuteRow($penjualan);
	$name = ExecuteRow($nama);
	$klinik = ExecuteRow("SELECT * FROM m_klinik WHERE id_klinik='".$result['id_klinik']."'");
	$sum_subtotal = ExecuteScalar("SELECT SUM(subtotal) FROM detailpenjualan WHERE id_penjualan = '$id_penjualan'");
	$voucher = ExecuteScalar("SELECT id_kartu FROM penjualan WHERE id = '$id_penjualan'");
	$metode_pembayaran = ExecuteScalar("SELECT metode_pembayaran FROM penjualan WHERE id = '$id_penjualan'");
	$bank = ExecuteScalar("SELECT id_bank FROM penjualan WHERE id = '$id_penjualan'");
	$id_kartubank = ExecuteScalar("SELECT id_kartubank FROM penjualan WHERE id = '$id_penjualan'");
	
	function rupiah($angka){
		 $hasil_rupiah = "Rp" . number_format($angka);
		 return $hasil_rupiah;
	}

	$sales = '';
	if($result['sales']) { 
		$sales = ExecuteScalar("SELECT nama_pegawai FROM m_pegawai WHERE id_pegawai = '".$result['sales']."'"); 
	}

	$dokter = '';
	if($result['dokter']) { 
		$dokter = ExecuteScalar("SELECT nama_pegawai FROM m_pegawai WHERE id_pegawai = '".$result['dokter']."'"); 
	}

	$be_wajah = '';
	if($result['dok_be_wajah']) { 
		$be_wajah = ExecuteScalar("SELECT nama_pegawai FROM m_pegawai WHERE id_pegawai = '".$result['dok_be_wajah']."'"); 
	}

	$be_body = '';
	if($result['be_body']) { 
		$be_body = ExecuteScalar("SELECT nama_pegawai FROM m_pegawai WHERE id_pegawai = '".$result['be_body']."'"); 
	}
	
?>

 <link rel="stylesheet" type="text/css" href="plugins/print/print.min.css">
 <script src="plugins/print/print.min.js"></script>
 <link rel="stylesheet" type="text/css" href="css/printstyle.css">
 
<div class="form-inline">
	<a class="btn btn-primary" href="/klinik/penjualanlist.php" role="button">Penjualan</a>
	<button type="button" class="btn btn-primary" onclick="printJS({
		printable: 'print',
		type: 'html',
		css: 'css/printstyle.css'
	})">Cetak</button>
</div>

<div id="print" style="font-size: 12px;">
	<table class="table-header">
		<tr>
			<td>No. Penjualan: <?php echo $result['kode_penjualan'] ?> </td>
			<td>
				Sales: <?php echo $sales; ?>
			</td>
		</tr>
		<tr>
			<td>Tgl: <?php echo $result['waktu']; ?> </td>
			<td>
				Dokter: <?php echo $dokter; ?>
			</td>
		</tr>
		<tr>
			<td>Nama: <?php echo $name['nama_pelanggan']; ?></td>
			<td>
				Be Wajah: <?php echo $be_wajah; ?>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				Be Body: <?php echo $be_body; ?>
			</td>
		</tr>
	</table>

	<hr/>

	<table class="daftar-produk">
		<?php
			$detail = "SELECT m_barang.shortname_barang, detailpenjualan.qty, detailpenjualan.harga_jual, detailpenjualan.disc_pr, detailpenjualan.subtotal FROM m_barang INNER JOIN detailpenjualan ON m_barang.id = detailpenjualan.id_barang WHERE id_penjualan='$id_penjualan'";
			$res = ExecuteRows($detail);
			$no=1;
				foreach ($res as $rs) {
									
				echo "<tr>
						<td>" . $no . ".</td>
						<td>" . $rs["shortname_barang"] . "</td>
						<td>" . $rs["qty"] . "</td>
						<td>" . rupiah($rs["harga_jual"]) . "</td>
						<td>" . $rs["disc_pr"] . "% </td>
						<td>" . rupiah($rs["subtotal"]) . "</td>
					</tr>" ;
				$no++;
				
			}
		?>
	</table>

	<hr />
	
	
<table class="total">
		<tr>
			<td>Ongkir</td>
			<td><?php echo rupiah($result['ongkir']) ?></td>
		</tr>
		<tr>
			<td>Subtotal</td>
			<td><?php echo rupiah($sum_subtotal) ?></td>
		</tr>
		<?php
			if(is_null($voucher) OR $voucher == FALSE){
			} else {
				$nominal_voucher = ExecuteScalar("SELECT charge_price FROM m_kartu WHERE id_kartu = '$voucher'");
				echo "<tr>
						<td>Voucher</td>
						<td>".rupiah($nominal_voucher)."</td>
					</tr>";
			}
		?>
		<tr>
			<td>Diskon</td>
			<td><?php echo $result['diskon_persen'] ?>%</td>
		</tr>
		<?php
			if($metode_pembayaran == 'Debit' OR $metode_pembayaran == 'Kredit'){
				$charge_type = ExecuteScalar("SELECT charge_type FROM m_kartu WHERE id_kartu='$id_kartubank'");
				$charge_price = ExecuteScalar("SELECT charge_price FROM m_kartu WHERE id_kartu='$id_kartubank'");
				//var_dump($charge);
				if($charge_type == 'Persentase'){
					echo "<tr>
							<td>Service Charge</td>
							<td>".$charge_price."</td>
						</tr>";
				} else {
					echo "<tr>
							<td>Service Charge</td>
							<td>".rupiah($charge_price)."</td>
						</tr>";					
				}

			} else if($metode_pembayaran == 'Tunai-Debit'){
				$charge_type = ExecuteScalar("SELECT charge_type FROM m_kartu WHERE id_kartu='$id_kartubank'");
				$charge_price = ExecuteScalar("SELECT charge_price FROM m_kartu WHERE id_kartu='$id_kartubank'");
				//var_dump($charge);
				if($charge_type == 'Persentase'){
					echo "<tr>
							<td>Service Charge</td>
							<td>".$charge_price."</td>
						</tr>";
				} else {
					echo "<tr>
							<td>Service Charge</td>
							<td>".rupiah($charge_price)."</td>
						</tr>";					
				}			
			} else if($metode_pembayaran == 'Tunai-Kredit') {
				$charge_type = ExecuteScalar("SELECT charge_type FROM m_kartu WHERE id_kartu='$id_kartubank'");
				$charge_price = ExecuteScalar("SELECT charge_price FROM m_kartu WHERE id_kartu='$id_kartubank'");
				//var_dump($charge);
				if($charge_type == 'Persentase'){
					echo "<tr>
							<td>Service Charge</td>
							<td>".$charge_price."</td>
						</tr>";
				} else {
					echo "<tr>
							<td>Service Charge</td>
							<td>".rupiah($charge_price)."</td>
						</tr>";					
				}
			}
		?>		
		<tr>
			<td>Grand Total</td>
			<td><?php echo rupiah($result['total']); ?></td>
		</tr>
		<tr>
			<td></td>
			<td><hr /></td>
		</tr>
		<?php
			if($metode_pembayaran == 'Debit'){
				echo "<tr>
						<td>Kartu Debit</td>
						<td>".rupiah($result['total_non_tunai_charge'])."</td>
					</tr>";				
			} else if($metode_pembayaran == 'Kredit'){
				echo "<tr>
						<td>Kartu Kredit</td>
						<td>".rupiah($result['total_non_tunai_charge'])."</td>
					</tr>";					
			} else if($metode_pembayaran == 'Tunai'){
				echo "<tr>
						<td>Bayar Tunai</td>
						<td>".rupiah($result['bayar'])."</td>
					</tr>";					
			} else if($metode_pembayaran == 'Tunai-Debit'){
				echo "<tr>
						<td>Bayar Tunai</td>
						<td>".rupiah($result['bayar'])."</td>
					</tr>
					<tr>
						<td>Kartu Debit</td>
						<td>".rupiah($result['total_non_tunai_charge'])."</td>
					</tr>";	
			} else if($metode_pembayaran == 'Tunai-Kredit'){
				echo "<tr>
						<td>Bayar Tunai</td>
						<td>".rupiah($result['bayar'])."</td>
					</tr>
					<tr>
						<td>Kartu Kredit</td>
						<td>".rupiah($result['total_non_tunai_charge'])."</td>
					</tr>";	
			}
		?>
		<!-- <tr>
			<td>Bayar</td>
			<td><?php echo rupiah($result['bayar'] + $result['bayar_non_tunai']) ?></td>
		</tr> -->
		<tr>
			<td>Kembali</td>
			<td><?php echo rupiah(($result['bayar'] + $result['total_non_tunai_charge']) - $result['total'])?></td>
		</tr>
		
	</table>

	<hr />
	<div class="footer">
		<img class="logo-alamanda" src="images/logo_medium.png"/>

		<div>Alamanda Clinic <?php echo $klinik['nama_klinik'] ?></div>
		<div><?php echo $klinik['alamat_klinik'] ?></div>
		<div>alamandaclinic.com</div>
		<div><?php echo $klinik['telpon_klinik'] ?></div>
	</div>
</div>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$struk_belanja->terminate();
?>