<?php
namespace PHPMaker2020\klinik_latest_09_04_21;
?>
<?php if ($kirimbarang->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_kirimbarangmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($kirimbarang->no_kirimbarang->Visible) { // no_kirimbarang ?>
		<tr id="r_no_kirimbarang">
			<td class="<?php echo $kirimbarang->TableLeftColumnClass ?>"><?php echo $kirimbarang->no_kirimbarang->caption() ?></td>
			<td <?php echo $kirimbarang->no_kirimbarang->cellAttributes() ?>>
<span id="el_kirimbarang_no_kirimbarang">
<span<?php echo $kirimbarang->no_kirimbarang->viewAttributes() ?>><?php echo $kirimbarang->no_kirimbarang->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($kirimbarang->id_po->Visible) { // id_po ?>
		<tr id="r_id_po">
			<td class="<?php echo $kirimbarang->TableLeftColumnClass ?>"><?php echo $kirimbarang->id_po->caption() ?></td>
			<td <?php echo $kirimbarang->id_po->cellAttributes() ?>>
<span id="el_kirimbarang_id_po">
<span<?php echo $kirimbarang->id_po->viewAttributes() ?>><?php echo $kirimbarang->id_po->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($kirimbarang->id_supplier->Visible) { // id_supplier ?>
		<tr id="r_id_supplier">
			<td class="<?php echo $kirimbarang->TableLeftColumnClass ?>"><?php echo $kirimbarang->id_supplier->caption() ?></td>
			<td <?php echo $kirimbarang->id_supplier->cellAttributes() ?>>
<span id="el_kirimbarang_id_supplier">
<span<?php echo $kirimbarang->id_supplier->viewAttributes() ?>><?php echo $kirimbarang->id_supplier->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($kirimbarang->id_klinik->Visible) { // id_klinik ?>
		<tr id="r_id_klinik">
			<td class="<?php echo $kirimbarang->TableLeftColumnClass ?>"><?php echo $kirimbarang->id_klinik->caption() ?></td>
			<td <?php echo $kirimbarang->id_klinik->cellAttributes() ?>>
<span id="el_kirimbarang_id_klinik">
<span<?php echo $kirimbarang->id_klinik->viewAttributes() ?>><?php echo $kirimbarang->id_klinik->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($kirimbarang->id_pegawai->Visible) { // id_pegawai ?>
		<tr id="r_id_pegawai">
			<td class="<?php echo $kirimbarang->TableLeftColumnClass ?>"><?php echo $kirimbarang->id_pegawai->caption() ?></td>
			<td <?php echo $kirimbarang->id_pegawai->cellAttributes() ?>>
<span id="el_kirimbarang_id_pegawai">
<span<?php echo $kirimbarang->id_pegawai->viewAttributes() ?>><?php echo $kirimbarang->id_pegawai->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($kirimbarang->tanggal->Visible) { // tanggal ?>
		<tr id="r_tanggal">
			<td class="<?php echo $kirimbarang->TableLeftColumnClass ?>"><?php echo $kirimbarang->tanggal->caption() ?></td>
			<td <?php echo $kirimbarang->tanggal->cellAttributes() ?>>
<span id="el_kirimbarang_tanggal">
<span<?php echo $kirimbarang->tanggal->viewAttributes() ?>><?php echo $kirimbarang->tanggal->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($kirimbarang->status_kirim->Visible) { // status_kirim ?>
		<tr id="r_status_kirim">
			<td class="<?php echo $kirimbarang->TableLeftColumnClass ?>"><?php echo $kirimbarang->status_kirim->caption() ?></td>
			<td <?php echo $kirimbarang->status_kirim->cellAttributes() ?>>
<span id="el_kirimbarang_status_kirim">
<span<?php echo $kirimbarang->status_kirim->viewAttributes() ?>><?php echo $kirimbarang->status_kirim->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($kirimbarang->keterangan->Visible) { // keterangan ?>
		<tr id="r_keterangan">
			<td class="<?php echo $kirimbarang->TableLeftColumnClass ?>"><?php echo $kirimbarang->keterangan->caption() ?></td>
			<td <?php echo $kirimbarang->keterangan->cellAttributes() ?>>
<span id="el_kirimbarang_keterangan">
<span<?php echo $kirimbarang->keterangan->viewAttributes() ?>><?php echo $kirimbarang->keterangan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>