<?php
namespace PHPMaker2020\sim_klinik_alamanda;
?>
<?php if ($penjualan->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_penjualanmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($penjualan->kode_penjualan->Visible) { // kode_penjualan ?>
		<tr id="r_kode_penjualan">
			<td class="<?php echo $penjualan->TableLeftColumnClass ?>"><?php echo $penjualan->kode_penjualan->caption() ?></td>
			<td <?php echo $penjualan->kode_penjualan->cellAttributes() ?>>
<span id="el_penjualan_kode_penjualan">
<span<?php echo $penjualan->kode_penjualan->viewAttributes() ?>><?php echo $penjualan->kode_penjualan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($penjualan->id_pelanggan->Visible) { // id_pelanggan ?>
		<tr id="r_id_pelanggan">
			<td class="<?php echo $penjualan->TableLeftColumnClass ?>"><?php echo $penjualan->id_pelanggan->caption() ?></td>
			<td <?php echo $penjualan->id_pelanggan->cellAttributes() ?>>
<span id="el_penjualan_id_pelanggan">
<span<?php echo $penjualan->id_pelanggan->viewAttributes() ?>><?php echo $penjualan->id_pelanggan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($penjualan->waktu->Visible) { // waktu ?>
		<tr id="r_waktu">
			<td class="<?php echo $penjualan->TableLeftColumnClass ?>"><?php echo $penjualan->waktu->caption() ?></td>
			<td <?php echo $penjualan->waktu->cellAttributes() ?>>
<span id="el_penjualan_waktu">
<span<?php echo $penjualan->waktu->viewAttributes() ?>><?php echo $penjualan->waktu->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($penjualan->total->Visible) { // total ?>
		<tr id="r_total">
			<td class="<?php echo $penjualan->TableLeftColumnClass ?>"><?php echo $penjualan->total->caption() ?></td>
			<td <?php echo $penjualan->total->cellAttributes() ?>>
<span id="el_penjualan_total">
<span<?php echo $penjualan->total->viewAttributes() ?>><?php echo $penjualan->total->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($penjualan->bayar->Visible) { // bayar ?>
		<tr id="r_bayar">
			<td class="<?php echo $penjualan->TableLeftColumnClass ?>"><?php echo $penjualan->bayar->caption() ?></td>
			<td <?php echo $penjualan->bayar->cellAttributes() ?>>
<span id="el_penjualan_bayar">
<span<?php echo $penjualan->bayar->viewAttributes() ?>><?php echo $penjualan->bayar->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($penjualan->total_non_tunai_charge->Visible) { // total_non_tunai_charge ?>
		<tr id="r_total_non_tunai_charge">
			<td class="<?php echo $penjualan->TableLeftColumnClass ?>"><?php echo $penjualan->total_non_tunai_charge->caption() ?></td>
			<td <?php echo $penjualan->total_non_tunai_charge->cellAttributes() ?>>
<span id="el_penjualan_total_non_tunai_charge">
<span<?php echo $penjualan->total_non_tunai_charge->viewAttributes() ?>><?php echo $penjualan->total_non_tunai_charge->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($penjualan->metode_pembayaran->Visible) { // metode_pembayaran ?>
		<tr id="r_metode_pembayaran">
			<td class="<?php echo $penjualan->TableLeftColumnClass ?>"><?php echo $penjualan->metode_pembayaran->caption() ?></td>
			<td <?php echo $penjualan->metode_pembayaran->cellAttributes() ?>>
<span id="el_penjualan_metode_pembayaran">
<span<?php echo $penjualan->metode_pembayaran->viewAttributes() ?>><?php echo $penjualan->metode_pembayaran->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($penjualan->id_kartubank->Visible) { // id_kartubank ?>
		<tr id="r_id_kartubank">
			<td class="<?php echo $penjualan->TableLeftColumnClass ?>"><?php echo $penjualan->id_kartubank->caption() ?></td>
			<td <?php echo $penjualan->id_kartubank->cellAttributes() ?>>
<span id="el_penjualan_id_kartubank">
<span<?php echo $penjualan->id_kartubank->viewAttributes() ?>><?php echo $penjualan->id_kartubank->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($penjualan->id_kas->Visible) { // id_kas ?>
		<tr id="r_id_kas">
			<td class="<?php echo $penjualan->TableLeftColumnClass ?>"><?php echo $penjualan->id_kas->caption() ?></td>
			<td <?php echo $penjualan->id_kas->cellAttributes() ?>>
<span id="el_penjualan_id_kas">
<span<?php echo $penjualan->id_kas->viewAttributes() ?>><?php echo $penjualan->id_kas->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($penjualan->charge->Visible) { // charge ?>
		<tr id="r_charge">
			<td class="<?php echo $penjualan->TableLeftColumnClass ?>"><?php echo $penjualan->charge->caption() ?></td>
			<td <?php echo $penjualan->charge->cellAttributes() ?>>
<span id="el_penjualan_charge">
<span<?php echo $penjualan->charge->viewAttributes() ?>><?php echo $penjualan->charge->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($penjualan->klaim_poin->Visible) { // klaim_poin ?>
		<tr id="r_klaim_poin">
			<td class="<?php echo $penjualan->TableLeftColumnClass ?>"><?php echo $penjualan->klaim_poin->caption() ?></td>
			<td <?php echo $penjualan->klaim_poin->cellAttributes() ?>>
<span id="el_penjualan_klaim_poin">
<span<?php echo $penjualan->klaim_poin->viewAttributes() ?>><?php echo $penjualan->klaim_poin->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($penjualan->total_penukaran_poin->Visible) { // total_penukaran_poin ?>
		<tr id="r_total_penukaran_poin">
			<td class="<?php echo $penjualan->TableLeftColumnClass ?>"><?php echo $penjualan->total_penukaran_poin->caption() ?></td>
			<td <?php echo $penjualan->total_penukaran_poin->cellAttributes() ?>>
<span id="el_penjualan_total_penukaran_poin">
<span<?php echo $penjualan->total_penukaran_poin->viewAttributes() ?>><?php echo $penjualan->total_penukaran_poin->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($penjualan->status->Visible) { // status ?>
		<tr id="r_status">
			<td class="<?php echo $penjualan->TableLeftColumnClass ?>"><?php echo $penjualan->status->caption() ?></td>
			<td <?php echo $penjualan->status->cellAttributes() ?>>
<span id="el_penjualan_status">
<span<?php echo $penjualan->status->viewAttributes() ?>><?php echo $penjualan->status->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($penjualan->jumlah_voucher->Visible) { // jumlah_voucher ?>
		<tr id="r_jumlah_voucher">
			<td class="<?php echo $penjualan->TableLeftColumnClass ?>"><?php echo $penjualan->jumlah_voucher->caption() ?></td>
			<td <?php echo $penjualan->jumlah_voucher->cellAttributes() ?>>
<span id="el_penjualan_jumlah_voucher">
<span<?php echo $penjualan->jumlah_voucher->viewAttributes() ?>><?php echo $penjualan->jumlah_voucher->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>