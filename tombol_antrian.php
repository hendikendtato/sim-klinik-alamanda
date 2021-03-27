<?php
namespace PHPMaker2020\klinik_latest_26_03_21;

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
$tombol_antrian = new tombol_antrian();

// Run the page
$tombol_antrian->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
<style>
	.header {
		margin-top: 4%;
	}

	.tombol {
		margin-top: 5%;
	}	

	.btn:hover {

	}

	.card {
		box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 3px 10px 0 rgba(0, 0, 0, 0.19);
	}

	.btn:active {
		transform: translateY(1px);
		color: white;
	}
	.btn-circle.btn-xl.button-antrian-beli {
		background-color:#D089FF;
		width: 150px;
		height: 150px;
		font-size: 24px;
		line-height: 1.33;
		border-radius: 75px;
	}
	.button-antrian-beli {
		background-color:#D089FF;
		height: 50px;
	}

	.btn-circle.btn-xl.button-antrian-konsultasi {
		background-color:#D6F8E7;
		width: 150px;
		height: 150px;
		font-size: 24px;
		line-height: 1.33;
		border-radius: 75px;
	}
	.button-antrian-konsultasi {
		background-color:#D6F8E7;
		height: 50px;
	}
	.btn-circle.btn-xl.button-antrian-perawatan {
		background-color:#AEE6FD;
		width: 150px;
		height: 150px;
		font-size: 24px;
		line-height: 1.33;
		border-radius: 75px;
	}
	.button-antrian-perawatan {
		background-color:#AEE6FD;
		height: 50px;
	}

</style>

<div class="container">

	<div class="header text-center">
		<div class="row justify-content-md-center">
			<div class="col-md-12 mb-3">
				<h1><b>WELCOME</b></h1>
			</div>
			<div class="col-md-4 text-right">
				<h4>Pilih Cabang</h4>
			</div>
			<div class="col-md-4 text-left">
				<select class="form-control klinik_select" name="cabang" id="id_cabang" onchange="changeFunction()" required>
					<option value="">Please Select</option>
					<?php
						$sql = "SELECT * FROM m_klinik";
						$res = ExecuteRows($sql);
						$get_current_id_klinik = CurrentUserInfo("id_klinik");
						$get_nama_klinik = ExecuteScalar("SELECT nama_klinik FROM m_klinik WHERE id_klinik = '$get_current_id_klinik'");

						if($get_current_id_klinik != '' && $get_current_id_klinik != NULL){
								echo "<option value=" . $get_nama_klinik . " selected>" . $get_nama_klinik . "</option>";
						} else {
							foreach ($res as $rs) {
								echo "<option value=" . $rs["nama_klinik"] . ">" . $rs["nama_klinik"] . "</option>";
							}
						}
					?>
				</select>
			</div>
		</div>
	</div>

	<?php
		$tanggal = date('Y-m-d');
		$tanggal2 = date('d/m/Y');
	?>

	<div class="tombol">
		<div class="row justify-content-md-center">
				<div class="col-md-3 text-center">
					<?php
						$sqlbeli = "SELECT * FROM antrian WHERE tanggal = '$tanggal' AND keperluan = 'Beli Produk' AND nama_klinik = '$get_nama_klinik' ORDER BY id DESC";
						$onwaiting = "SELECT COUNT(id) AS CountOnWaiting FROM antrian WHERE keperluan = 'Beli Produk' AND selesai='belum' AND tanggal = '$tanggal' AND nama_klinik = '$get_nama_klinik'";
						$antrianbeli = ExecuteRow($sqlbeli);
						$jumlahonwaiting = ExecuteRow($onwaiting);
					?>

					<div class="card text-center">
						<div class="card-body">
							<h4 class="text-center mt-4"> <b>BELI PRODUK</b> </h4>
							<p class="card-text mt-4"> <b><?php echo $tanggal2 ?></b> </p>
							<button type="button" class="btn btn-circle btn-xl mt-4 mb-2 button-antrian-beli" disabled><h1><b><?php echo $jumlahonwaiting['CountOnWaiting'] ?></b></h1></button>
							<p class="card-text mt-4"> <b>On Waiting List</b> </p>
							<button type="button" class="btn btn-lg btn-block button-antrian-beli mt-5 mb-4" data-toggle="modal" data-target="#modalbeli"><b>
							<?php if (!$antrianbeli) {
								echo 'Ambil Antrian';
							} else {
								echo $antrianbeli['nomor_antrian']; 
							}
							?> </b></button>
						</div>
					</div>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-3">
					<div class="card text-center">
					<?php
						$sqlkonsultasi = "SELECT * FROM antrian WHERE tanggal = '$tanggal' AND keperluan = 'Konsultasi' AND nama_klinik = '$get_nama_klinik' ORDER BY id DESC";
						$antriankonsultasi = ExecuteRow($sqlkonsultasi);
						$onwaitingkonsultasi = "SELECT COUNT(id) AS CountOnWaitingKonsul FROM antrian WHERE keperluan = 'Konsultasi' AND selesai='belum' AND tanggal = '$tanggal' AND nama_klinik = '$get_nama_klinik'";
						$jumlahonwaitingkonsultasi = ExecuteRow($onwaitingkonsultasi);
					?>
						<div class="card-body">
							<h4 class="text-center mt-4"> <b>KONSULTASI</b> </h4>
							<p class="card-text mt-4"> <b><?php echo $tanggal2 ?></b> </p>
							<button type="button" class="btn btn-circle btn-xl mt-4 mb-2 button-antrian-konsultasi" disabled><h1><b><?php echo $jumlahonwaitingkonsultasi['CountOnWaitingKonsul'] ?></b></h1></button>
							<p class="card-text mt-4"> <b>On Waiting List</b> </p>
							<button type="button" class="btn btn-lg btn-block button-antrian-konsultasi mt-5 mb-4" data-toggle="modal" data-target="#modalkonsultasi"><b>
							<?php if (!$antriankonsultasi) {
								echo 'Ambil Antrian';
							} else {
								echo $antriankonsultasi['nomor_antrian']; 
							}
							?> </b></button>
						</div>
					</div>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-3">
					<div class="card text-center">
					<?php
						$sqlperawatan = "SELECT * FROM antrian WHERE tanggal = '$tanggal' AND keperluan = 'Perawatan' AND nama_klinik = '$get_nama_klinik' ORDER BY id DESC";
						$antrianperawatan = ExecuteRow($sqlperawatan);
						$onwaitingperawatan = "SELECT COUNT(id) AS CountOnWaitingPerawatan FROM antrian WHERE keperluan = 'Perawatan' AND selesai='belum' AND tanggal = '$tanggal' AND nama_klinik = '$get_nama_klinik'";
						$jumlahonwaitingperawatan = ExecuteRow($onwaitingperawatan);
					?>
						<div class="card-body">
							<h4 class="text-center mt-4"> <b>PERAWATAN</b> </h4>
							<p class="card-text mt-4"> <b><?php echo $tanggal2 ?></b> </p>
							<button type="button" class="btn btn-circle btn-xl mt-4 mb-2 button-antrian-perawatan" disabled><h1><b><?php echo $jumlahonwaitingperawatan['CountOnWaitingPerawatan'] ?></b></h1></button>
							<p class="card-text mt-4"> <b>On Waiting List</b> </p>
							<button type="button" class="btn btn-lg btn-block button-antrian-perawatan mt-5 mb-4" data-toggle="modal" data-target="#modalperawatan"><b>
							<?php if (!$antrianperawatan) {
								echo 'Ambil Antrian';
							} else {
								echo $antrianperawatan['nomor_antrian']; 
							}
							?> </b></button>
						</div>
					</div>
				</div>
		</div>
		<!-- <div class="row text-center">
				<div class="col-md-4 text-center">
					<button class="btn btn-default btn-circle btn-xl" id="btn-action-beli" ><i class="glyphicon glyphicon-ok">AMBIL ANTRIAN</i></button>
					<h3 class="mt-4"><b>BELI PRODUK</b></h3>	
				</div>
				<div class="col-md-4">
					<button class="btn btn-default btn-circle btn-xl" id="btn-action-konsultasi"><i class="glyphicon glyphicon-ok">AMBIL ANTRIAN</i></button>
					<h3 class="mt-4"><b>KONSULTASI</b></h3>	
				</div>
				<div class="col-md-4">
					<button class="btn btn-default btn-circle btn-xl" id="btn-action-perawatan"><i class="glyphicon glyphicon-ok">AMBIL ANTRIAN</i></button>
					<h3 class="mt-4"><b>PERAWATAN</b></h3>	
				</div>
		</div> -->
	</div>
</div>

<!-- MODAL BELI-->
<div class="modal fade" id="modalbeli" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
	<div class="modal-content">
	  <div class="modal-body">
	  	<h5 class="modal-title text-center mt-2" id="strukLabel"></h5>
		<p class="text-center mt-4 mb-4" style="color:#D089FF;"><b>ANTRIAN BELI PRODUK</b></p>
		<h1 class="text-center">
			<b>
				<?php 
					$antrian_beli_sebelumnya = ExecuteScalar("SELECT nomor_antrian FROM antrian WHERE keperluan='Beli Produk' AND tanggal='$tanggal' AND nama_klinik = '$get_nama_klinik' ORDER BY id DESC");
					if ($antrian_beli_sebelumnya == NULL) {
						echo 'B-'. date('d'). '-0001';
					} else {
						$kode_beli = explode('-', $antrian_beli_sebelumnya);
						$kodeantrian = $kode_beli[0];
						$hari = date('d');
						$nomor_urut_terakhir = substr($kode_beli[2], -4);
						if ($hari == date('d')) {
							$nomor_urut_beli = sprintf('%04d', (int)$nomor_urut_terakhir + 1);
						} else {
							$nomor_urut_beli = sprintf('%04d', 1);
						}
						$urutanselanjutnya = "$kodeantrian-$hari-$nomor_urut_beli";
	
						echo $urutanselanjutnya;
					}
				?>
			</b>
		</h1>
		<p class="text-center mt-4"><?php $time = date('d/m/Y H:i:s'); echo $time; ?></p>
		<button class="btn btn-lg btn-block button-antrian-beli mt-5 mb-4" id="postActionBeli"><b>AMBIL ANTRIAN</b></button>
	  </div>
	</div>
  </div>
</div>

<!-- MODAL KONSULTASI-->
<div class="modal fade" id="modalkonsultasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
	<div class="modal-content">
	  <div class="modal-body">
	  <h5 class="modal-title text-center mt-2" id="strukLabel2"></h5>	  
		<p class="text-center mt-4 mb-4" style="color:#D6F8E7;"><b>ANTRIAN KONSULTASI</b></p>
		<h1 class="text-center">
			<b>
				<?php 
					$antrian_konsultasi_sebelumnya = ExecuteScalar("SELECT nomor_antrian FROM antrian WHERE keperluan='Konsultasi' AND tanggal='$tanggal' AND nama_klinik = '$get_nama_klinik' ORDER BY id DESC");
					if ($antrian_konsultasi_sebelumnya == NULL) {
						echo 'K-'. date('d'). '-0001';
					} else {
						$kode_konsultasi = explode('-', $antrian_konsultasi_sebelumnya);
						$kodeantrian = $kode_konsultasi[0];
						$hari = date('d');
						$nomor_urut_terakhir = substr($kode_konsultasi[2], -4);
						if ($hari == date('d')) {
							$nomor_urut_konsultasi = sprintf('%04d', (int)$nomor_urut_terakhir + 1);
						} else {
							$nomor_urut_konsultasi = sprintf('%04d', 1);
						}
						$urutanselanjutnya = "$kodeantrian-$hari-$nomor_urut_konsultasi";
	
						echo $urutanselanjutnya;
					}
				?>
			</b>
		</h1>
		<p class="text-center mt-4"><?php $time = date('d/m/Y H:i:s'); echo $time; ?></p>
		<button class="btn btn-lg btn-block button-antrian-konsultasi mt-5 mb-4" id="postActionKonsultasi"><b>AMBIL ANTRIAN</b></button>
	  </div>
	</div>
  </div>
</div>

<!-- MODAL PERAWATAN-->
<div class="modal fade" id="modalperawatan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
	<div class="modal-content">
	  <div class="modal-body">
	  <h5 class="modal-title text-center mt-2" id="strukLabel3"></h5>
		<p class="text-center mt-4 mb-4" style="color:#AEE6FD;"><b>ANTRIAN PERAWATAN</b></p>
		<h1 class="text-center">
			<b>
				<?php 
					$antrian_perawatan_sebelumnya = ExecuteScalar("SELECT nomor_antrian FROM antrian WHERE keperluan='Perawatan'  AND tanggal='$tanggal' AND nama_klinik = '$get_nama_klinik' ORDER BY id DESC");
					if($antrian_perawatan_sebelumnya == NULL) {
						echo 'P-'. date('d'). '-0001';
					} else {
						$kode_perawatan = explode('-', $antrian_perawatan_sebelumnya);
						$kodeantrian = $kode_perawatan[0];
						$hari = $kode_perawatan[1];
						$nomor_urut_terakhir = substr($kode_perawatan[2], -4);
						if ($hari == date('d')) {
							$nomor_urut_perawatan = sprintf('%04d', (int)$nomor_urut_terakhir + 1);
						} else {
							$nomor_urut_perawatan = sprintf('%04d', 1);
						}
						$urutanselanjutnya = "$kodeantrian-$hari-$nomor_urut_perawatan";
	
						echo $urutanselanjutnya;
					}
				?>
			</b>
		</h1>
		<p class="text-center mt-4"><?php $time = date('d/m/Y H:i:s'); echo $time; ?></p>
		<button type="submit" class="btn btn-lg btn-block button-antrian-perawatan mt-5 mb-4" id="postActionPerawatan"><b>AMBIL ANTRIAN</b></button>
	  </div>
	</div>
  </div>
</div>
<!-- <iframe id="templateprint" style="display:none" name="frame1"></iframe> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js" integrity="sha512-quHCp3WbBNkwLfYUMd+KwBAgpVukJu5MncuQaWXgCrfgcxCJAq/fo+oqrRKOj+UKEmyMCG3tb8RB63W+EmrOBg==" crossorigin="anonymous"></script>
<script>
	function btnLoading(btnId) {
		$('#'+btnId).prop('disabled', true);
		$('#'+btnId).empty();
		$('#'+btnId).html('<i class="fa fa-spinner fa-spin"></i>');
	}

	function changeFunction() {
		var cabang = document.getElementById("id_cabang").value;
		document.getElementById("strukLabel").innerHTML = "Alamanda Clinic " + cabang;
		document.getElementById("strukLabel2").innerHTML = "Alamanda Clinic " + cabang;
		document.getElementById("strukLabel3").innerHTML = "Alamanda Clinic " + cabang;
	}

	$('.klinik_select').change(function(){
		$(this).attr('data-changed', 'true');
	});

	$('.klinik_select option:selected').each(function() {
		if($("#id_cabang").val() != ''){
			$('.klinik_select').attr('data-changed', 'true');
			var cabang = document.getElementById("id_cabang").value;
			document.getElementById("strukLabel").innerHTML = "Alamanda Clinic " + cabang;
			document.getElementById("strukLabel2").innerHTML = "Alamanda Clinic " + cabang;
			document.getElementById("strukLabel3").innerHTML = "Alamanda Clinic " + cabang;
		}
	});

	$("#postActionBeli").click(function() {

		if($('.klinik_select[data-changed]').length == 0) {
			alert('Pilih Klinik Terlebih Dahulu'); return
		}
		
		$('.klinik_select[data-changed]').each(function() {

		btnLoading("postActionBeli");
		var cabang = $("#id_cabang").val();

		$.get(`${base_url}api/?action=postActionBeli&nama_klinik=${cabang}`)
			.then(function (response) {
				// handle success
				console.log(response.data);
				//window.location.reload();
				$("#nomor_saat_ini").load(location.href + " #nomor_saat_ini");
				document.location = "struk_antrian.php";
				
				// divs['frame1'].print();
			})
			.catch(function (error) {
				// handle error
				console.log(error);
				
			})
		});
	});

	$("#postActionKonsultasi").click(function() {

		if($('.klinik_select[data-changed]').length == 0) {
			alert('Pilih Klinik Terlebih Dahulu'); return
		}
		
		$('.klinik_select[data-changed]').each(function() {

		btnLoading("postActionKonsultasi");
		var cabang = $("#id_cabang").val();

		$.get(`${base_url}api/?action=postActionKonsultasi&nama_klinik=${cabang}`)
			.then(function (response) {
				// handle success
				console.log(response.data);
				//window.location.reload();
				$("#nomor_saat_ini").load(location.href + " #nomor_saat_ini");
				document.location = "struk_antrian.php";
				// divs['frame1'].print();
			})
			.catch(function (error) {
				// handle error
				console.log(error);
				
			})
		});
	});

	$("#postActionPerawatan").click(function() {

		if($('.klinik_select[data-changed]').length == 0) {
			alert('Pilih Klinik Terlebih Dahulu'); return
		}
		
		$('.klinik_select[data-changed]').each(function() {
		
		btnLoading("postActionPerawatan");
		var cabang = $("#id_cabang").val();

		$.get(`${base_url}api/?action=postActionPerawatan&nama_klinik=${cabang}`)
			.then(function (response) {
				// handle success
				console.log(response.data);
				//window.location.reload();
				$("#nomor_saat_ini").load(location.href + " #nomor_saat_ini");
				document.location = "struk_antrian.php";
				// divs['frame1'].print();
			})
			.catch(function (error) {
				// handle error
				console.log(error);
				
			})
		});
	});

</script>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$tombol_antrian->terminate();
?>