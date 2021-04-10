<?php
namespace PHPMaker2020\klinik_latest_09_04_21;
?>
<?php if ($returbarang->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_returbarangmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($returbarang->id_retur->Visible) { // id_retur ?>
		<tr id="r_id_retur">
			<td class="<?php echo $returbarang->TableLeftColumnClass ?>"><?php echo $returbarang->id_retur->caption() ?></td>
			<td <?php echo $returbarang->id_retur->cellAttributes() ?>>
<span id="el_returbarang_id_retur">
<span<?php echo $returbarang->id_retur->viewAttributes() ?>><?php echo $returbarang->id_retur->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($returbarang->kode->Visible) { // kode ?>
		<tr id="r_kode">
			<td class="<?php echo $returbarang->TableLeftColumnClass ?>"><?php echo $returbarang->kode->caption() ?></td>
			<td <?php echo $returbarang->kode->cellAttributes() ?>>
<span id="el_returbarang_kode">
<span<?php echo $returbarang->kode->viewAttributes() ?>><?php echo $returbarang->kode->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($returbarang->id_klinik->Visible) { // id_klinik ?>
		<tr id="r_id_klinik">
			<td class="<?php echo $returbarang->TableLeftColumnClass ?>"><?php echo $returbarang->id_klinik->caption() ?></td>
			<td <?php echo $returbarang->id_klinik->cellAttributes() ?>>
<span id="el_returbarang_id_klinik">
<span<?php echo $returbarang->id_klinik->viewAttributes() ?>><?php echo $returbarang->id_klinik->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($returbarang->id_supplier->Visible) { // id_supplier ?>
		<tr id="r_id_supplier">
			<td class="<?php echo $returbarang->TableLeftColumnClass ?>"><?php echo $returbarang->id_supplier->caption() ?></td>
			<td <?php echo $returbarang->id_supplier->cellAttributes() ?>>
<span id="el_returbarang_id_supplier">
<span<?php echo $returbarang->id_supplier->viewAttributes() ?>><?php echo $returbarang->id_supplier->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($returbarang->id_pegawai->Visible) { // id_pegawai ?>
		<tr id="r_id_pegawai">
			<td class="<?php echo $returbarang->TableLeftColumnClass ?>"><?php echo $returbarang->id_pegawai->caption() ?></td>
			<td <?php echo $returbarang->id_pegawai->cellAttributes() ?>>
<span id="el_returbarang_id_pegawai">
<span<?php echo $returbarang->id_pegawai->viewAttributes() ?>><?php echo $returbarang->id_pegawai->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($returbarang->tanggal->Visible) { // tanggal ?>
		<tr id="r_tanggal">
			<td class="<?php echo $returbarang->TableLeftColumnClass ?>"><?php echo $returbarang->tanggal->caption() ?></td>
			<td <?php echo $returbarang->tanggal->cellAttributes() ?>>
<span id="el_returbarang_tanggal">
<span<?php echo $returbarang->tanggal->viewAttributes() ?>><?php echo $returbarang->tanggal->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($returbarang->status->Visible) { // status ?>
		<tr id="r_status">
			<td class="<?php echo $returbarang->TableLeftColumnClass ?>"><?php echo $returbarang->status->caption() ?></td>
			<td <?php echo $returbarang->status->cellAttributes() ?>>
<span id="el_returbarang_status">
<span<?php echo $returbarang->status->viewAttributes() ?>><?php echo $returbarang->status->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($returbarang->keterangan->Visible) { // keterangan ?>
		<tr id="r_keterangan">
			<td class="<?php echo $returbarang->TableLeftColumnClass ?>"><?php echo $returbarang->keterangan->caption() ?></td>
			<td <?php echo $returbarang->keterangan->cellAttributes() ?>>
<span id="el_returbarang_keterangan">
<span<?php echo $returbarang->keterangan->viewAttributes() ?>><?php echo $returbarang->keterangan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>