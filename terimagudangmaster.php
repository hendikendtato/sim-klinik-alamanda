<?php
namespace PHPMaker2020\sim_klinik_alamanda;
?>
<?php if ($terimagudang->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_terimagudangmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($terimagudang->kode_terimagudang->Visible) { // kode_terimagudang ?>
		<tr id="r_kode_terimagudang">
			<td class="<?php echo $terimagudang->TableLeftColumnClass ?>"><?php echo $terimagudang->kode_terimagudang->caption() ?></td>
			<td <?php echo $terimagudang->kode_terimagudang->cellAttributes() ?>>
<span id="el_terimagudang_kode_terimagudang">
<span<?php echo $terimagudang->kode_terimagudang->viewAttributes() ?>><?php echo $terimagudang->kode_terimagudang->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($terimagudang->id_klinik->Visible) { // id_klinik ?>
		<tr id="r_id_klinik">
			<td class="<?php echo $terimagudang->TableLeftColumnClass ?>"><?php echo $terimagudang->id_klinik->caption() ?></td>
			<td <?php echo $terimagudang->id_klinik->cellAttributes() ?>>
<span id="el_terimagudang_id_klinik">
<span<?php echo $terimagudang->id_klinik->viewAttributes() ?>><?php echo $terimagudang->id_klinik->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($terimagudang->diterima->Visible) { // diterima ?>
		<tr id="r_diterima">
			<td class="<?php echo $terimagudang->TableLeftColumnClass ?>"><?php echo $terimagudang->diterima->caption() ?></td>
			<td <?php echo $terimagudang->diterima->cellAttributes() ?>>
<span id="el_terimagudang_diterima">
<span<?php echo $terimagudang->diterima->viewAttributes() ?>><?php echo $terimagudang->diterima->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($terimagudang->tanggal_terima->Visible) { // tanggal_terima ?>
		<tr id="r_tanggal_terima">
			<td class="<?php echo $terimagudang->TableLeftColumnClass ?>"><?php echo $terimagudang->tanggal_terima->caption() ?></td>
			<td <?php echo $terimagudang->tanggal_terima->cellAttributes() ?>>
<span id="el_terimagudang_tanggal_terima">
<span<?php echo $terimagudang->tanggal_terima->viewAttributes() ?>><?php echo $terimagudang->tanggal_terima->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($terimagudang->keterangan->Visible) { // keterangan ?>
		<tr id="r_keterangan">
			<td class="<?php echo $terimagudang->TableLeftColumnClass ?>"><?php echo $terimagudang->keterangan->caption() ?></td>
			<td <?php echo $terimagudang->keterangan->cellAttributes() ?>>
<span id="el_terimagudang_keterangan">
<span<?php echo $terimagudang->keterangan->viewAttributes() ?>><?php echo $terimagudang->keterangan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>