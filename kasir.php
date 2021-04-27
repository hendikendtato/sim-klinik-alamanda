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
$kasir = new kasir();

// Run the page
$kasir->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
<style>
	.row.row-identity {
		margin-bottom: 10px;
	}

	input#tanggal, input#kode-penjualan, input#pelanggan, input#sales {
		width: 100%;
	}

	select.form-control.product-select {
		width: 100%;
	}

	button.btn.btn-primary.mb-2.product-select-button {
		width: 100%;
		height: 40px;
	}

	button.btn.btn-primary.save-transaction {
		width: 100%;
		height: 50px;
	}

	.price-summary .row {
		margin-bottom: 20px;
	}

	.product-list {
		padding-right: 20px;
	}

	input.form-control.diskon-persen, input.form-control.ppn-persen {
		width: 50%;
	}

	input.form-control.diskon-rp, input.form-control.ppn-rp {
		width: 65%;
	}

	.col-5.subtotal {
		text-align: right;
	}

	.col-5.total-number {
		text-align: right;
	}
</style>

<script src="js/jquery-3.5.1.slim.min.js"></script>

<script>
	var harga_jual = {
		<?php
			$sql = "select * from m_hargajual";
			$res = ExecuteRows($sql);

			foreach ($res as $rs) {
				$id_hargajual = $rs["id_hargajual"];
				$id_barang = $rs["id_barang"];
				$totalhargajual = $rs["totalhargajual"];
									
				$sql = "select * from m_barang where id=" . $id_barang;
				$barang = ExecuteRow($sql);

				echo "barang_" . $barang["id"] . ": {";
				echo "id:'" . $barang["id"] . "',";
				echo "kode_barang:'" . $barang["kode_barang"] . "',";
				echo "nama_barang:'" . $barang["nama_barang"] . "',";
				echo "},";
			}
		?>
	};

	console.log(harga_jual);
	$.each(harga_jual, function(key, value) {
		console.log(value.nama_barang);
	});
</script>

<div class="container-fluid">
	<div class="form-row row-identity">
		<div class="form-group col-md-3">
			<label for="kode-penjualan">Kode Penjualan</label>
			<input type="text" class="form-control" id="kode-penjualan" placeholder="Kode Penjualan">
		</div>

		<div class="form-group col-md-3">
			<label for="pelanggan">Pelanggan</label>
			<input type="text" class="form-control" id="pelanggan" placeholder="Pelanggan">
		</div>

		<div class="form-group col-md-3">
			<label for="tanggal">Tanggal</label>
			<input type="date" class="form-control" id="tanggal">
		</div>

		<div class="form-group col-md-3">
			<label for="sales">Sales</label>
			<input type="text" class="form-control" id="sales" placeholder="Sales">
		</div>
	</div>
	
	<div class="row">
		<div class="col-7 product-list">
			<div class="row">
				<div class="col-11">
					<div class="form-group">
						<select class="form-control product-select">
							<?php
								$sql = "select * from m_hargajual";
								$res = ExecuteRows($sql);

								foreach ($res as $rs) {
									$id_hargajual = $rs["id_hargajual"];
									$id_barang = $rs["id_barang"];
									$totalhargajual = $rs["totalhargajual"];
									
									$sql = "select * from m_barang where id=" . $id_barang;
									$barang = ExecuteRow($sql);

									
									echo "<option id=" . $barang["id"] . "value=" . $barang["nama_barang"] . ">" . $barang["nama_barang"] . "</option>";
								}
							?>
						</select>

					
					</div>
				</div>

				<div class="col-1">
					<button type="submit" class="btn btn-primary mb-2 product-select-button">
						<i class="fa fa-plus" aria-hidden="true"></i>
					</button>
				</div>
			</div>

			<table class="table">
				<thead>
					<tr>
						<th scope="col">Nama Produk</th>
						<th scope="col">Harga</th>
						<th scope="col">Jumlah</th>
						<th scope="col">Subtotal</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Alamanda Laser Scar 1</td>
						<td>Rp20000</td>
						<td><input type="number" class="form-control" name="jumlah" min="1" max="999999"></td>
						<td>Rp20000</td>
					</tr>
					<tr>
						<td>Alamanda Laser Scar 1</td>
						<td>Rp20000</td>
						<td><input type="number" class="form-control" name="jumlah" min="1" max="999999"></td>
						<td>Rp20000</td>
					</tr>
					<tr>
						<td>Alamanda Laser Scar 1</td>
						<td>Rp20000</td>
						<td><input type="number" class="form-control" name="jumlah" min="1" max="999999"></td>
						<td>Rp20000</td>
					</tr>
					<tr>
						<td>Alamanda Laser Scar 1</td>
						<td>Rp20000</td>
						<td><input type="number" class="form-control" name="jumlah" min="1" max="999999"></td>
						<td>Rp20000</td>
					</tr>
					<tr>
						<td>Alamanda Laser Scar 1</td>
						<td>Rp20000</td>
						<td><input type="number" class="form-control" name="jumlah" min="1" max="999999"></td>
						<td>Rp20000</td>
					</tr>
					<tr>
						<td>Alamanda Laser Scar 1</td>
						<td>Rp20000</td>
						<td><input type="number" class="form-control" name="jumlah" min="1" max="999999"></td>
						<td>Rp20000</td>
					</tr>
					<tr>
						<td>Alamanda Laser Scar 1</td>
						<td>Rp20000</td>
						<td><input type="number" class="form-control" name="jumlah" min="1" max="999999"></td>
						<td>Rp20000</td>
					</tr>
				</tbody>
			</table>
			
		</div>
		<div class="col-5 price-summary">
			<div class="row row-subtotal">
				<div class="col-3 subtotal-label">
					<strong>Subtotal</strong>
				</div>

				<div class="col-4 subtotal">
				
				</div>

				<div class="col-5 subtotal">
					Rp12000000
				</div>
			</div>
		
			<div class="form-group row row-diskon">
				<label for="diskon" class="col-sm-3 col-form-label"><strong>Diskon</strong></label>
				<div class="col-sm-4">
	  				<div class="input-group">
	  					<input class="form-control diskon-persen" aria-describedby="diskon-persen-append">
  						<div class="input-group-append">
							<span class="input-group-text" id="diskon-persen-append">%</span>
						</div>
  					</div>
	  			</div>

	  			<div class="col-sm-5">
	  				<div class="input-group">
	  					<div class="input-group-prepend">
	  						<span class="input-group-text" id="diskon-rp-prepend">Rp</span>
	  					</div>
	  					<input class="form-control diskon-rp" aria-describedby="diskon-rp-prepend">
  					</div>
	  			</div>
			</div>

			<div class="form-group row">
				<label for="diskon-persen" class="col-sm-3 col-form-label"><strong>PPN</strong></label>
				<div class="col-sm-4">
	  				<div class="input-group">
	  					<input class="form-control ppn-persen" aria-describedby="ppn-persen-append">
  						<div class="input-group-append">
							<span class="input-group-text" id="ppn-persen-append">%</span>
						</div>
  					</div>
	  			</div>

	  			<div class="col-sm-5">
	  				<div class="input-group">
	  					<div class="input-group-prepend">
	  						<span class="input-group-text" id="ppn-rp-prepend">Rp</span>
	  					</div>
	  					<input class="form-control ppn-rp" aria-describedby="ppn-rp-append">
  					</div>
	  			</div>
			</div>

			<div class="row row-total">
				<div class="col-3 total-label">
					<strong>Total</strong>
				</div>

				<div class="col-4">
					<h1 class="display-4"></h1>
				</div>
			
				<div class="col-5 total-number">
					<strong>Rp12000000</strong>
				</div>
			</div>

			<button type="submit" class="btn btn-primary save-transaction">
				Simpan
			</button>
			
		</div>
	</div>
</div>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$kasir->terminate();
?>