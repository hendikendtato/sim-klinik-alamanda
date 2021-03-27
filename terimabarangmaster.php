<?php
namespace PHPMaker2020\klinik_latest_26_03_21;
?>
<?php if ($terimabarang->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_terimabarangmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($terimabarang->no_terima->Visible) { // no_terima ?>
		<tr id="r_no_terima">
			<td class="<?php echo $terimabarang->TableLeftColumnClass ?>"><?php echo $terimabarang->no_terima->caption() ?></td>
			<td <?php echo $terimabarang->no_terima->cellAttributes() ?>>
<span id="el_terimabarang_no_terima">
<span<?php echo $terimabarang->no_terima->viewAttributes() ?>><?php echo $terimabarang->no_terima->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($terimabarang->id_kirimbarang->Visible) { // id_kirimbarang ?>
		<tr id="r_id_kirimbarang">
			<td class="<?php echo $terimabarang->TableLeftColumnClass ?>"><?php echo $terimabarang->id_kirimbarang->caption() ?></td>
			<td <?php echo $terimabarang->id_kirimbarang->cellAttributes() ?>>
<span id="el_terimabarang_id_kirimbarang">
<span<?php echo $terimabarang->id_kirimbarang->viewAttributes() ?>><?php echo $terimabarang->id_kirimbarang->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($terimabarang->id_po->Visible) { // id_po ?>
		<tr id="r_id_po">
			<td class="<?php echo $terimabarang->TableLeftColumnClass ?>"><?php echo $terimabarang->id_po->caption() ?></td>
			<td <?php echo $terimabarang->id_po->cellAttributes() ?>>
<span id="el_terimabarang_id_po">
<span<?php echo $terimabarang->id_po->viewAttributes() ?>><?php echo $terimabarang->id_po->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($terimabarang->id_supplier->Visible) { // id_supplier ?>
		<tr id="r_id_supplier">
			<td class="<?php echo $terimabarang->TableLeftColumnClass ?>"><?php echo $terimabarang->id_supplier->caption() ?></td>
			<td <?php echo $terimabarang->id_supplier->cellAttributes() ?>>
<span id="el_terimabarang_id_supplier">
<span<?php echo $terimabarang->id_supplier->viewAttributes() ?>><?php echo $terimabarang->id_supplier->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($terimabarang->id_klinik->Visible) { // id_klinik ?>
		<tr id="r_id_klinik">
			<td class="<?php echo $terimabarang->TableLeftColumnClass ?>"><?php echo $terimabarang->id_klinik->caption() ?></td>
			<td <?php echo $terimabarang->id_klinik->cellAttributes() ?>>
<span id="el_terimabarang_id_klinik">
<span<?php echo $terimabarang->id_klinik->viewAttributes() ?>><?php echo $terimabarang->id_klinik->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($terimabarang->id_pegawai->Visible) { // id_pegawai ?>
		<tr id="r_id_pegawai">
			<td class="<?php echo $terimabarang->TableLeftColumnClass ?>"><?php echo $terimabarang->id_pegawai->caption() ?></td>
			<td <?php echo $terimabarang->id_pegawai->cellAttributes() ?>>
<span id="el_terimabarang_id_pegawai">
<span<?php echo $terimabarang->id_pegawai->viewAttributes() ?>><?php echo $terimabarang->id_pegawai->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($terimabarang->tanggal_terima->Visible) { // tanggal_terima ?>
		<tr id="r_tanggal_terima">
			<td class="<?php echo $terimabarang->TableLeftColumnClass ?>"><?php echo $terimabarang->tanggal_terima->caption() ?></td>
			<td <?php echo $terimabarang->tanggal_terima->cellAttributes() ?>>
<span id="el_terimabarang_tanggal_terima">
<span<?php echo $terimabarang->tanggal_terima->viewAttributes() ?>><?php echo $terimabarang->tanggal_terima->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($terimabarang->keterangan->Visible) { // keterangan ?>
		<tr id="r_keterangan">
			<td class="<?php echo $terimabarang->TableLeftColumnClass ?>"><?php echo $terimabarang->keterangan->caption() ?></td>
			<td <?php echo $terimabarang->keterangan->cellAttributes() ?>>
<span id="el_terimabarang_keterangan">
<span<?php echo $terimabarang->keterangan->viewAttributes() ?>><?php echo $terimabarang->keterangan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>