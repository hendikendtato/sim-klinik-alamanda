<?php
namespace PHPMaker2020\klinik_latest_08_04_21;
?>
<?php if ($penyesuaian_poin->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_penyesuaian_poinmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($penyesuaian_poin->kode_penyesuaianpoin->Visible) { // kode_penyesuaianpoin ?>
		<tr id="r_kode_penyesuaianpoin">
			<td class="<?php echo $penyesuaian_poin->TableLeftColumnClass ?>"><?php echo $penyesuaian_poin->kode_penyesuaianpoin->caption() ?></td>
			<td <?php echo $penyesuaian_poin->kode_penyesuaianpoin->cellAttributes() ?>>
<span id="el_penyesuaian_poin_kode_penyesuaianpoin">
<span<?php echo $penyesuaian_poin->kode_penyesuaianpoin->viewAttributes() ?>><?php echo $penyesuaian_poin->kode_penyesuaianpoin->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($penyesuaian_poin->id_klinik->Visible) { // id_klinik ?>
		<tr id="r_id_klinik">
			<td class="<?php echo $penyesuaian_poin->TableLeftColumnClass ?>"><?php echo $penyesuaian_poin->id_klinik->caption() ?></td>
			<td <?php echo $penyesuaian_poin->id_klinik->cellAttributes() ?>>
<span id="el_penyesuaian_poin_id_klinik">
<span<?php echo $penyesuaian_poin->id_klinik->viewAttributes() ?>><?php echo $penyesuaian_poin->id_klinik->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($penyesuaian_poin->tgl->Visible) { // tgl ?>
		<tr id="r_tgl">
			<td class="<?php echo $penyesuaian_poin->TableLeftColumnClass ?>"><?php echo $penyesuaian_poin->tgl->caption() ?></td>
			<td <?php echo $penyesuaian_poin->tgl->cellAttributes() ?>>
<span id="el_penyesuaian_poin_tgl">
<span<?php echo $penyesuaian_poin->tgl->viewAttributes() ?>><?php echo $penyesuaian_poin->tgl->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>