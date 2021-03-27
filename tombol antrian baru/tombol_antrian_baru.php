<style>
	.header {
		margin-top: 4%;
	}

	.nomor_saat_ini {
		margin-top: 9%;
	}

	.tombol {
		margin-top: 9%;
	}	

	.btn:hover {

	}

	.btn:active {
		background-color: #3e8e41;
		box-shadow: 0 5px #666;
		transform: translateY(2px);
		color: white;
	}
	.btn-circle.btn-xl {
		width: 350px;
		height: 150px;
		/* padding: 10px 16px; */
		font-size: 24px;
		line-height: 1.33;
		border-color: #3e8e41;
		/* border-radius: 75px; */
		box-shadow: 2px 5px #999;
	}
</style>

<div class="container">

	<div class="header text-center">
		<div class="col-md-12">
			<h1><b>WELCOME</b></h1>
		</div>
	</div>

	<?php
		$tanggal = date('yy-m-d');
	?>

	<div class="nomor_saat_ini" id="nomor_saat_ini">
		<div class="row text-center">
			<div class="col-md-4 text-center">
				<?php
					$sqlbeli = "SELECT * FROM antrian WHERE tanggal = '$tanggal' AND keperluan = 'Beli Produk' ORDER BY id DESC";
					$antrianbeli = ExecuteRow($sqlbeli);
				?>
				<h4>Antrian terakhir</h4>
				<h2 class="nomor_saat_ini"><?php if(isset($antrianbeli['nomor_antrian'])) { echo $antrianbeli['nomor_antrian']; } ?></h2>	
			</div>
			<div class="col-md-4">
				<?php
					$sqlkonsultasi = "SELECT * FROM antrian WHERE tanggal = '$tanggal' AND keperluan = 'Konsultasi' ORDER BY id DESC";
					$antriankonsultasi = ExecuteRow($sqlkonsultasi);
				?>
				<h4>Antrian terakhir</h4>
				<h2 class="nomor_saat_ini"><?php if(isset($antriankonsultasi['nomor_antrian'])) { echo $antriankonsultasi['nomor_antrian']; } ?></h2>
			</div>
			<div class="col-md-4">
				<?php
					$sqlperawatan = "SELECT * FROM antrian WHERE tanggal = '$tanggal' AND keperluan = 'Perawatan' ORDER BY id DESC";
					$antrianperawatan = ExecuteRow($sqlperawatan);
				?>
					<h4>Antrian terakhir</h4>
					<h2 class="nomor_saat_ini"><?php if(isset($antrianperawatan['nomor_antrian'])) { echo $antrianperawatan['nomor_antrian']; } ?></h2>	
			</div>
		</div>
	</div>

	<div class="tombol">
		<div class="row text-center">
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
		</div>
	</div>
</div>

<div name="frame1"></div>
<!-- <iframe id="templateprint" style="display:none" name="frame1"></iframe> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js" integrity="sha512-quHCp3WbBNkwLfYUMd+KwBAgpVukJu5MncuQaWXgCrfgcxCJAq/fo+oqrRKOj+UKEmyMCG3tb8RB63W+EmrOBg==" crossorigin="anonymous"></script>
<script src="http://localhost:5656/socket.io/socket.io.js"></script>
<script>
  // Connect to our node/websockets server
  var socket = io.connect('http://localhost:5656');

	$("#btn-action-beli").click(async function() { 
		await axios.post('http://localhost/klinik/api/?action=add&object=antrian', {
			keperluan:'Beli Produk'
		})
			.then(function (response) {
				// handle success
		console.log(response.data);
		
		// emit antrian beli produk
		socket.emit('add antrian beli', response.data);

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

	$("#btn-action-konsultasi").click(function() { 
		axios.post('http://localhost/klinik/api/?action=add&object=antrian', {
			keperluan:'Konsultasi'
		})
			.then(function (response) {
				// handle success
		console.log(response.data);
		
		// emit antrian beli produk
		socket.emit('add antrian konsultasi', response.data);

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

	$("#btn-action-perawatan").click(function() { 
		axios.post('http://localhost/klinik/api/?action=add&object=antrian', {
			keperluan:'Perawatan'
		})
			.then(function (response) {
				// handle success
		console.log(response.data);
		
		// emit antrian beli produk
		socket.emit('add antrian perawatan', response.data);

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

</script>